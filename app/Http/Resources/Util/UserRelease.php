<?php

namespace App\Http\Resources\Util;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Util\Release as ReleaseResource;

class UserRelease extends JsonResource
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
            'release' => new ReleaseResource($this->release)
        ];
    }
}
