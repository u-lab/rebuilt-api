<?php

namespace App\Http\Resources\Util;

use Illuminate\Http\Resources\Json\JsonResource;

class Image extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'         => $this->id,
            'title'      => $this->title,
            'url'        => $this->url,
            'url_80'     => $this->url_80,
            'url_160'    => $this->url_160,
            'url_320'    => $this->url_320,
            'url_640'    => $this->url_640,
            'url_1024'   => $this->url_1024,
            'url_1280'   => $this->url_1280,
            'url_1920'   => $this->url_1920,
            'url_2580'   => $this->url_2580,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
