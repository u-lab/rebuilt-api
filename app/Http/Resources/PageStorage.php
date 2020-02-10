<?php

namespace App\Http\Resources;

use App\Http\Resources\PageStorageUser as PageStorageUserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PageStorage extends JsonResource
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
            "data" => parent::toArray($request),
            "user" => new PageStorageUserResource($this->user)
        ];
    }
}
