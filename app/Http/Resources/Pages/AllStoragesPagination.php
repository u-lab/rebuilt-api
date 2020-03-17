<?php

namespace App\Http\Resources\Pages;

use App\Http\Resources\Pages\Storage as StorageResouce;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AllStoragesPagination extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return StorageResouce::collection($this->collection);
    }
}
