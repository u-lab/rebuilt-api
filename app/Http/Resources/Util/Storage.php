<?php

namespace App\Http\Resources\Util;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Util\Image as ImageResource;

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
            "storage_id"         => $this->storage_id,
            "title"              => $this->title,
            "description"        => $this->description,
            "long_comment"       => $this->long_comment,
            "storage_url"        => $this->storage_url,
            "eyecatch_image_url" => $this->eyecatch_image_url,
            "eyecatch_image"     => new ImageResource($this->eyecatch_image),
            "web_address"        => $this->web_address,
            "created_at"         => $this->created_at,
            "updated_at"         => $this->updated_at,
        ];
    }
}
