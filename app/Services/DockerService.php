<?php

namespace App\Services;


use App\Models\Ping;
use GuzzleHttp\Client;
use Illuminate\Support\Sleep;

class DockerService
{
    private $client;
    private $logger;
    
    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'http://192.168.1.116:2375/v1.41',
            'timeout' => 5.0
        ]);
        $this->logger = logger();
        
        $this->logger->info('process to create container');
    }
    
    public function createPingContainer(Ping $ping): void
    {
        // Validate the IP address
        if (!filter_var($ping->ip, FILTER_VALIDATE_IP)) {
            throw new \InvalidArgumentException('Invalid IP address: ' . $ping->ip);
        }
        
        try {
            $this->logger->info('start creating container');
            // Create the container
            $response = $this->client->post('/containers/create', [
                'json' => [
                    'Image' => 'alpine',
                    'Cmd' => ['ping', '-c', $ping->max_ping, $ping->ip]
                ]
            ]);
            
            $container = json_decode((string)$response->getBody(), true);
            
            // Start the container
            $this->startContainer($container['Id']);
            
            Sleep::for(10)->seconds();
            
            $logs = $this->getContainerLogs($container['Id']);
            
            $parsedLogs = $this->parseContainerLogs($logs);
            
            $this->storeContainerLogs($parsedLogs, $ping, $container['Id']);
            
            $ping->update(['status' => 1]);
            
            $this->logger->info('container is created');
        } catch (\Exception $e) {
            $ping->update(['status' => 2]);
            $this->logger->error($e->getMessage());
        }
    }
    
    public function startContainer(string $containerId): void
    {
        try {
            
            $this->client->post('/containers/' . $containerId . '/start');
            
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            throw $e;
        }
    }
    
    public function getContainerLogs(string $containerId): string
    {
        try {
            // Stream the container logs (include both stdout and stderr)
            $response = $this->client->get('/containers/' . $containerId . '/logs?stdout=1&stderr=1&follow=1');
            $stream = $response->getBody();
            
            // Read the logs until the stream is closed
            $logs = '';
            while (!$stream->eof()) {
                $logs .= $stream->read(1024);
            }
            
            return $logs;
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            throw $e;
        }
    }
    
    protected function parseContainerLogs($logs): array
    {
        preg_match('/(\d+) packets transmitted, (\d+) packets received, (\d+)% packet loss/', $logs, $results);
        $packetLoss = (int)$results[3];
        
        preg_match('/(\d+\.\d+)\/(\d+\.\d+)\/(\d+\.\d+)/', $logs, $matches);
        $minRtt = (float)$matches[1];
        $avgRtt = (float)$matches[2];
        $maxRtt = (float)$matches[3];
        
        return [
            'container_id' => '',
            'packets_transmitted' => $results[1],
            'packets_received' => $results[2],
            'packet_loss' => $packetLoss,
            'min' => $minRtt,
            'avg' => $avgRtt,
            'max' => $maxRtt,
        ];
    }
    
    protected function storeContainerLogs(array $logs, Ping $ping, string $containerId): void
    {
        try {
            
            if ($logs['packets_received'] != 0) {
                $logs['container_id'] = $containerId;
                $ping->containers()->create($logs);
            }
            
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
        }
        
    }
    
}
