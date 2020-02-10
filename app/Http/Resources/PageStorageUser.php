<?php

namespace App\Http\Resources;

use App\Http\Resources\PageUserProfile as PageUserProfileResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PageStorageUser extends JsonResource
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
            'name' => $this->name,
            'user_profile' => new PageUserProfileResource($this->user_profile)
        ];
    }
}
