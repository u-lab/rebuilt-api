<?php

namespace App\Http\Resources\Util;

use Illuminate\Http\Resources\Json\Resource;

class StorageFile extends Resource
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
            'id'        => $this->id,
            'url'       => $this->url,
            'extension' => $this->extension
        ];
    }
}
