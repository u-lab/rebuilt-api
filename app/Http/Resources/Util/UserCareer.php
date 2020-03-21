<?php

namespace App\Http\Resources\Util;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCareer extends ResourceCollection
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
            'date' => $this->date,
            'name' => $this->name
        ];
    }
}
