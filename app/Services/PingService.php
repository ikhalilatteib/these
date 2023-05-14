<?php

namespace App\Services;


use App\Models\Ping;
use GuzzleHttp\Client;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Sleep;

class PingService
{
    private $client;
    private $logger;
    
    public function __construct(public Ping $ping)
    {
        $this->logger = Log::channel('single');
        
        try {
            $this->client = new Client([
                'base_uri' => config('services.docker.endpoint'),
                'timeout' => config('services.docker.timeout')
            ]);
        } catch (\Exception $e) {
            $this->saveEventualErrors($e);
            $this->logger->error($e->getMessage());
        }
        
    }
    
    public function createPingContainer(): void
    {
        // Validate the IP address
        if (!filter_var($this->ping->ip, FILTER_VALIDATE_IP)) {
            throw new \InvalidArgumentException('Invalid IP address: ' . $this->ping->ip);
        }
        $this->ping->containers()->delete();
        
        try {
            $this->logger->info('start creating container');
            for ($i = 0; $i < $this->ping->container; $i++) {     // Create the container
                $response = $this->client->post('/containers/create', [
                    'json' => [
                        'Image' => 'alpine',
                        'Cmd' => ['ping', '-c', $this->ping->max_ping, $this->ping->ip]
                    ]
                ]);
                
                $container = json_decode((string)$response->getBody(), true);
                
                // Start the container
                $this->logger->info('Started container with ID: ' . $container['Id']);
                $this->startContainer($container['Id']);
                
                
                Sleep::for(10)->seconds();
                
                $this->stopContainer($container['Id']);
                
                $operation_time = $this->containerRunTime($container['Id']);
                
                $logs = $this->getContainerLogs($container['Id']);
                
                $parsedLogs = $this->parseContainerLogs($logs);
                
                $this->storeContainerLogs($parsedLogs, $container['Id'], $operation_time);
            }
            $this->ping->update(['status' => 1]);
            
            $this->logger->info('container is created');
        } catch (\Exception $e) {
            $this->saveEventualErrors($e);
            $this->logger->error($e->getMessage());
        }
    }
    
    public function startContainer(string $containerId)
    {
        try {
            if (empty($containerId)) {
                throw new \InvalidArgumentException('Invalid container ID');
            }
            
            $this->client->post('/containers/' . $containerId . '/start');
            
        } catch (\Exception $e) {
            $this->saveEventualErrors($e, $this->ping);
            $this->logger->error($e->getMessage());
        }
    }
    
    public function stopContainer(string $containerId)
    {
        try {
            if (empty($containerId)) {
                throw new \InvalidArgumentException('Invalid container ID');
            }
            
            $this->client->post('/containers/' . $containerId . '/stop');
            
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
            $data['min'] = $matches[1] ?? '0';
            $data['avg'] = $matches[2] ?? '0';
            $data['max'] = $matches[3] ?? '0';
        }
        
        return $data;
    }
    
    protected function storeContainerLogs(array $logs, string $containerId, $operation_time): void
    {
        try {
            
            $logs['operation_time'] = $operation_time;
            $logs['container_id'] = $containerId;
            $this->ping->containers()->create($logs);
            
        } catch (\Exception $e) {
            $this->saveEventualErrors($e, $this->ping);
            $this->logger->error($e->getMessage());
        }
        
    }
    
    protected function saveEventualErrors($e): void
    {
        $this->ping->update(['status' => 2]);
        
        $this->ping->errorLogs()->create([
            'message' => $e->getMessage(),
            'code' => $e->getCode(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString(),
        ]);
    }
    
    protected function containerRunTime($containerID)
    {
        try {
            $response = $this->client->get('/containers/' . $containerID . '/json');
            
            $container = json_decode((string)$response->getBody(), true);
            
            $start = Carbon::create($container['State']['StartedAt']);
            return Carbon::create($container['State']['FinishedAt'])->diffInSeconds($start);
        } catch (\Exception $e) {
            $this->saveEventualErrors($e, $this->ping);
            $this->logger->error($e->getMessage());
        }
    }
    
}
