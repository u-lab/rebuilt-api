<?php

namespace App\Listeners;

use App\Events\ResizeImageDetectionEvent;
use App\Services\FileSystem\ImageService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ResizeImageRecordListener implements ShouldQueue
{
    /**
     * ジョブが処理開始されるまでの時間（秒）
     *
     * @var int
     */
    public $delay = 1;

    /**
     * 最大試行回数
     *
     * @var int
     */
    public $tries = 5;

    protected $_imageService;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(ImageService $imageService)
    {
        $this->_imageService = $imageService;
    }

    /**
     * Handle the event.
     *
     * @param  ResizeImageDetectionEvent  $event
     * @return void
     */
    public function handle(ResizeImageDetectionEvent $event)
    {
        $this->_imageService->store_resize_image_repository($event->url, $event->path, $event->image_id, $event->filename);
    }
}
