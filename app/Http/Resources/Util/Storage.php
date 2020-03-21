<?php

namespace App\Http\Resources\Util;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Util\Image as ImageResource;
use App\Http\Resources\Util\Release as ReleaseResource;
use App\Http\Resources\Util\StorageFile as StorageFileResource;
use App\Http\Resources\Util\StorageSubImage as StorageSubImageResource;

class Storage extends JsonResource
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
            "user_id"             => $this->user_id,
            "storage_id"          => $this->storage_id,
            "release"             => new ReleaseResource($this->release),
            "title"               => $this->title,
            "description"         => $this->description,
            "long_comment"        => $this->long_comment,
            "storage_file"        => new StorageFileResource($this->storage_file),
            "storage_sub_image"   => StorageSubImageResource::collection($this->storage_sub_imaeg),
            "eyecatch_image_id"   => $this->eyecatch_image_id,
            "eyecatch_image"      => new ImageResource($this->eyecatch_image),
            "web_address"         => $this->web_address,
            "created_at"          => $this->created_at,
            "updated_at"          => $this->updated_at,
        ];
    }
}
