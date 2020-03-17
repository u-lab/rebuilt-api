<?php

namespace App\Http\Resources\Pages;

use App\Http\Resources\Pages\Page as PageResouce;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AllPagesPagination extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return PageResouce::collection($this->collection);
    }
}
