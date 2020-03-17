<?php

namespace App\Http\Resources\Util;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Util\Storage as StorageResource;

class UserPortfolio extends JsonResource
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
            "user_id"                => $this->user_id,
            "masterpiece_storage_id" => $this->masterpiece_storage_id,
            "masterpiece_storage"    => new StorageResource($this->storage),
            "long_comment"           => $this->long_comment,
            "created_at"             => $this->created_at,
            "updated_at"             => $this->updated_at
        ];
    }
}

