<?php

namespace App\Http\Resources\Users;

use Illuminate\Http\Resources\Json\JsonResource;

class Profile extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'created_at'     => $this->created_at,
            'description'    => $this->description,
            'hobby'          => $this->hobby,
            'icon_image_url' => $this->icon_image_url,
            'job_name'       => $this->job_name,
            'nick_name'      => $this->nick_name,
            'updated_at'     => $this->updated_at,
            'user_id'        => $this->user_id,
            'web_address'    => $this->web_address,
        ];
    }
}
