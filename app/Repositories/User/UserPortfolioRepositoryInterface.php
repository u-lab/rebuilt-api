<?php

namespace App\Repositories\User;

interface UserPortfolioRepositoryInterface
{
    /**
     * UserIDによってUserPortfolioを取得
     *
     * @param string $id
     * @return void
     */
    public function get_user_portfolio_by_id(string $id);
}
