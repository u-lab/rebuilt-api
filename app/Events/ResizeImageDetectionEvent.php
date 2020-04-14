<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ResizeImageDetectionEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $url;

    public $path;

    public $image_id;

    public $filename;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($url, $path, $image_id, $filename)
    {
        $this->url = $url;
        $this->path = $path;
        $this->image_id = $image_id;
        $this->filename = $filename;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
