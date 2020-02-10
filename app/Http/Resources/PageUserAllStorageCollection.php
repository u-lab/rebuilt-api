<?php

namespace App\Http\Resources;

use App\Http\Resources\PageStorageUser as PageStorageUserResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PageUserAllStorageCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "data" => PageUserAllStorage::collection($this->collection),
            "user" => new PageStorageUserResource($this->collection[0]->user)
        ];
    }
}
