<?php

namespace App\Http\Resources\Users;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Users\Storage as StorageResoucre;

class Page extends JsonResource
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
            'user_id'             => $this->user_id,
            'long_comment'        => $this->long_comment,
            'created_at'          => $this->created_at,
            'updated_at'          => $this->updated_at,
            'masterpiece_storage' => new StorageResoucre($this->storage),
        ];
    }
}
