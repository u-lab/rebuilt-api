<?php

namespace App\Http\Resources\Util;

use Illuminate\Http\Resources\Json\ResourceCollection;

class StorageFile extends ResourceCollection
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
            'url'       => $this->url,
            'extension' => $this->extension
        ];
    }
}
