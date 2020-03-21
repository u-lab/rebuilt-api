<?php

namespace App\Http\Resources\Util;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Util\Image as ImageResource;

class StorageSubImage extends ResourceCollection
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
            'image' => new ImageResource($this->image)
        ];
    }
}
