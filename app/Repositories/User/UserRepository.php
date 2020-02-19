<?php

namespace App\Repositories\User;

use App\User;
use App\Repositories\User\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    /**
     * 名前によってユーザーデータを取得する
     *
     * @param string $user_name
     * @return \Illuminate\Database\Eloquent\Model|object|static|null
     */
    public function get_user_by_name(string $user_name)
    {
        $user = User::whereName($user_name)->first();

        return $user;
    }

    /**
     * user_idを取得する
     *
     * @param string $user_name
     * @return integer
     */
    public function get_user_id(string $user_name): int
    {
        return $this->get_user_by_name($user_name)->id;
    }
}
