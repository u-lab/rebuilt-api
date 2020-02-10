<?php

namespace App\Repositories\User;

use App\User;
use App\Repositories\User\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function get_user_page(string $user_name): array
    {
        $user = User::select(['id', 'name', 'created_at', 'updated_at'])
            ->whereName($user_name)
            ->with(['user_profile', 'user_portfolio'])
            ->get();

        return $user->toArray();
    }
}
