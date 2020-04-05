<?php

namespace App\Listeners;

use App\Events\AccessApiDetectionEvent;
use App\Services\Logging\HttpApiService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AccessIpAndRouteRecordListener
{
    /**
     * @var \App\Services\Logging\HttpApiService
     */
    protected $_service;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(HttpApiService $service)
    {
        $this->_service = $service;
    }

    /**
     * Handle the event.
     *
     * @param  AccessApiDetectionEvent  $event
     * @return void
     */
    public function handle(AccessApiDetectionEvent $event)
    {
        $this->_service->record($event->ip, $event->message);
    }
}
