<?php

namespace App\Http\Resources\Util;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Util\Image as ImageResource;

class UserProfile extends JsonResource
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
            'user_id'             => $this->user_id,
            'nick_name'           => $this->nick_name,
            'job_name'            => $this->job_name,
            'hobby'               => $this->hobby,
            'description'         => $this->description,
            'icon_image_id'       => $this->icon_image_id,
            'icon_image'          => new ImageResource($this->icon_image),
            "background_image_id" => $this->background_image_id,
            "background_image"    => new ImageResource($this->background_image),
            'web_address'         => $this->web_address,
            'created_at'          => $this->created_at,
            'updated_at'          => $this->updated_at
        ];
    }
}
