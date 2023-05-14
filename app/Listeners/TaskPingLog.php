<?php

namespace App\Listeners;

use App\Events\TaskPingCreated;
use App\Services\PingService;
use Illuminate\Contracts\Queue\ShouldQueue;

class TaskPingLog implements ShouldQueue
{
    
    public $timeout = 300;
    
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
        (new PingService($event->ping))->createPingContainer();
    }
}
