<?php

namespace App\Repositories\User;

use App\User;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\User\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @param string $user_name
     * @return \Illuminate\Database\Eloquent\Model|object|static|null
     */
    public function get_user_by_name(string $user_name)
    {
        $user = User::whereName($user_name)->first();

        return $user;
    }
}
