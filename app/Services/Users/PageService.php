<?php

namespace App\Services\Users;

use App\Http\Resources\Users\Page as PageResource;
use App\Repositories\User\UserPortfolioRepositoryInterface;

class PageService
{
    /**
     * @var \App\Repositories\User\UserPortfolioRepositoryInterface
     */
    private $_userPortfolioRepository;

    public function __construct(UserPortfolioRepositoryInterface $userPortfolioRepositoryInterface)
    {
        $this->_userPortfolioRepository = $userPortfolioRepositoryInterface;
    }

    public function get_user_page($request)
    {
        $user = $request->user();
        $user_portfolio = $this->_userPortfolioRepository->get_user_portfolio_by_id($user->id);
        return new PageResource($user_portfolio);
    }
}
