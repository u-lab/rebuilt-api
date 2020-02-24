<?php

namespace App\Repositories\User;

interface UserPortfolioRepositoryInterface
{
    /**
     * UserIDによってUserPortfolioを取得
     *
     * @param string $id
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|static|static[]
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function get_user_portfolio_by_id(string $user_id);
}
