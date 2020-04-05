<?php

namespace App\Listeners;

use App\Events\ModelNotFoundDetectionEvent;
use App\Services\Logging\ModelNotFoundService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ModelNotFoundRecordListener implements ShouldQueue
{
    /**
     * ジョブが処理開始されるまでの時間（秒）
     *
     * @var int
     */
    public $delay = 60;

    /**
     * Undocumented variable
     *
     * @var \App\Services\Logging\ModelNotFoundService
     */
    protected $_service;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(ModelNotFoundService $service)
    {
        $this->_service = $service;
    }

    /**
     * Handle the event.
     *
     * @param  ModelNotFoundDetectionEvent  $event
     * @return void
     */
    public function handle(ModelNotFoundDetectionEvent $event)
    {
        $this->_service->record($event->message);
    }
}
