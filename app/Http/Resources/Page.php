<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\PageUserInfo as PageUserInfoResource;
use App\Http\Resources\PageUserProfile as PageUserProfileResource;
use App\Http\Resources\PageUserPortfolio as PageUserPortfolioResource;

class Page extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user_info' => new PageUserInfoResource($this->user_info),
            'user_profile' => new PageUserProfileResource($this->user_profile),
            'user_portfolio' => new PageUserPortfolioResource($this->user_portfolio),
        ];
    }
}
