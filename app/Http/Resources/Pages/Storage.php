<?php

namespace App\Http\Resources\Pages;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Pages\Page as PageResource;
use App\Http\Resources\Util\Storage as StorageResource;

class Storage extends JsonResource
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
            "data" => new StorageResource($this),
            "user" => new PageResource($this->user)
        ];
    }
}
