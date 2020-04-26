<?php

namespace App\Repositories\User;

interface UserRoleRepositoryInterface
{
    public function create(int $user_id, int $role_id);
}
