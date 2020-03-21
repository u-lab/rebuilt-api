<?php

namespace App\Http\Resources\Pages;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Util\UserInfo as UserInfoResource;
use App\Http\Resources\Util\UserCareer as UserCareerResource;
use App\Http\Resources\Util\UserProfile as UserProfileResource;
use App\Http\Resources\Util\UserPortfolio as UserPortfolioResource;

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
            'id'             => $this->id,
            'name'           => $this->name,
            'created_at'     => $this->created_at,
            'updated_at'     => $this->updated_at,
            'user_info'      => new UserInfoResource($this->user_info),
            'user_profile'   => new UserProfileResource($this->user_profile),
            'user_portfolio' => new UserPortfolioResource($this->user_portfolio),
            'user_career'    => UserCareerResource::collection($this->user_career),
        ];
    }
}
