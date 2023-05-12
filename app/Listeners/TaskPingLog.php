<?php

namespace App\Listeners;

use App\Events\TaskPingCreated;
use App\Services\DockerService;
use Illuminate\Contracts\Queue\ShouldQueue;

class TaskPingLog implements ShouldQueue
{
    
    public $timeout = 180;
    
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(TaskPingCreated $event): void
    {
        (new DockerService())->createPingContainer($event->ping);
    }
}
