<?php

namespace App\Http\Resources\Util;

use Illuminate\Http\Resources\Json\Resource;
use App\Http\Resources\Util\Image as ImageResource;

class StorageSubImage extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return new ImageResource($this->image);
    }
}
