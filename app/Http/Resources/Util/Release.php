<?php

namespace App\Http\Resources\Util;

use Illuminate\Http\Resources\Json\JsonResource;

class Release extends JsonResource
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
            'id'            => $this->id,
            'release_name'  => $this->release_name,
            'release_level' => $this->release_level
        ];
    }
}
