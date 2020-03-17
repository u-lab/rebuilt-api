<?php

namespace App\Http\Resources\Util;

use Illuminate\Http\Resources\Json\JsonResource;

class UserInfo extends JsonResource
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
            "user_id"     => $this->user_id,
            "last_name"   => $this->last_name,
            "first_name"  => $this->first_name,
            "school_name" => $this->school_name,
            "birthday"    => $this->birthday,
            "prefecture"  => $this->prefecture,
            "city"        => $this->city,
            "street"      => $this->street,
            "created_at"  => $this->created_at,
            "updated_at"  => $this->updated_at
        ];
    }
}
