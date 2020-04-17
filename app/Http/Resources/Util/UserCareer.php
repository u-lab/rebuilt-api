<?php

namespace App\Http\Resources\Util;

use Illuminate\Http\Resources\Json\Resource;

class UserCareer extends Resource
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
            'id'   => $this->id,
            'date' => $this->date,
            'name' => $this->name,
            'type' => $this->type
        ];
    }
}
