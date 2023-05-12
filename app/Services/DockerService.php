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
        try {
            $this->client = new Client([
                'base_uri' => config('services.docker.endpoint'),
                'timeout' => config('services.docker.timeout')
            ]);
            $this->logger = logger();
            $this->logger->info('process to create container');
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
        }
        
    }
    
    public function createPingContainer(Ping $ping): void
    {
        // Validate the IP address
        if (!filter_var($ping->ip, FILTER_VALIDATE_IP)) {
            throw new \InvalidArgumentException('Invalid IP address: ' . $ping->ip);
        }
        $ping->containers()->delete();
        
        try {
            $this->logger->info('start creating container');
            for ($i = 0; $i < $ping->container; $i++) {     // Create the container
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
            }
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
            return '';
        }
    }
    
    protected function parseContainerLogs(string $log): array
    {
        $data = [
            'packets_transmitted' => '',
            'packets_received' => '',
            'packet_loss' => '',
            'min' => '',
            'avg' => '',
            'max' => '',
            'log' => $log
        ];
        
        preg_match('/(\d+) packets transmitted, (\d+) packets received, (\d+)% packet loss/', $log, $results);
        if (isset($results)) {
            $data['packet_loss'] = $results[3] ?? '';
            $data['packets_transmitted'] = $results[1] ?? '';
            $data['packets_received'] = $results[2] ?? '0';
        }
        
        preg_match('/(\d+\.\d+)\/(\d+\.\d+)\/(\d+\.\d+)/', $log, $matches);
        if (isset($matches)) {
            $data['min'] = $matches[1] ?? '';
            $data['avg'] = $matches[2] ?? '';
            $data['max'] = $matches[3] ?? '';
        }
        
        return $data;
    }
    
    protected function storeContainerLogs(array $logs, Ping $ping, string $containerId): void
    {
        try {
            
            $logs['container_id'] = $containerId;
            $ping->containers()->create($logs);
            
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
        }
        
    }
    
}
