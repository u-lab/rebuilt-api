<?php

namespace App\Services\Users;

use App\Repositories\User\UserRoleRepositoryInterface;
use App\User;

class UserRoleService
{
    protected $_userRoleRepository;

    public function __construct(UserRoleRepositoryInterface $userRoleRepositoryInterface)
    {
        $this->_userRoleRepository = $userRoleRepositoryInterface;
    }

    public function create(User $user, int $role_id = 2)
    {
        $this->_userRoleRepository->create($user->id, $role_id);
    }
}
