<?php

namespace App\Repositories\User;

use App\Models\UserPortfolio;

interface UserPortfolioRepositoryInterface
{
    public function get_user_portfolio_by_id(string $id);
}
