<?php

namespace App\Repositories\User;

use App\Models\UserRole;
use App\Repositories\User\UserRoleRepositoryInterface;

class UserRoleRepository implements UserRoleRepositoryInterface
{
    protected $_userRole;

    public function __construct(UserRole $userRole)
    {
        $this->_userRole = $userRole;
    }

    public function create(int $user_id, int $role_id)
    {
        return $this->_userRole->create(['user_id' => $user_id, 'role_id' => $role_id]);
    }
}
