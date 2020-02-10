<?php

namespace App\Repositories\User;

interface UserRepositoryInterface
{
    /**
     * @param string $user_name
     * @return \Illuminate\Database\Eloquent\Model|object|static|null
     */
    public function get_user_by_name(string $user_name);

    public function get_user_id(string $user_name): int;
}
