<?php

namespace App\Listeners;

use App\Events\MaintainModeDetectionEvent;
use App\Services\Logging\SlackService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class MaintainModeRecordListener
{
    protected $_service;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(SlackService $service)
    {
        $this->_service = $service;
    }

    /**
     * Handle the event.
     *
     * @param  MaintainModeDetectionEvent  $event
     * @return void
     */
    public function handle(MaintainModeDetectionEvent $event)
    {
        $this->_service->send($event->message);
    }
}
