<?php

namespace App\Http\Resources\Pages;

use App\Http\Resources\Pages\Page as PageResource;
use App\Http\Resources\Util\Storage as StorageResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class StoragePagination extends ResourceCollection
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
            "data" => StorageResource::collection($this->collection),
            // "user" => new PageResource($this->collection[0]->user)
        ];
    }
}
