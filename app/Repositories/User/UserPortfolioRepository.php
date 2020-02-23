<?php

namespace App\Repositories\User;

use App\Models\UserPortfolio;
use App\Repositories\User\UserPortfolioRepositoryInterface;

class UserPortfolioRepository implements UserPortfolioRepositoryInterface
{
    /**
     * UserIDによってUserPortfolioを取得
     *
     * @param string $id
     * @return void
     */
    public function get_user_portfolio_by_id(string $id)
    {
        return UserPortfolio::find($id);
    }
}
