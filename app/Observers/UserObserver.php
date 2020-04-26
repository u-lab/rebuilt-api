<?php

namespace App\Observers;

use App\Services\Users\UserReleaseService;
use App\Services\Users\UserRoleService;
use App\User;

class UserObserver
{
    protected $_userReleaseService;

    protected $_userRoleService;

    public function __construct(UserReleaseService $userReleaseService, UserRoleService $userRoleService)
    {
        $this->_userReleaseService = $userReleaseService;
        $this->_userRoleService = $userRoleService;
    }

    /**
     * Handle to the User "created" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function created(User $user)
    {
        $this->_userReleaseService->create($user);
        $this->_userRoleService->create($user);
    }
}
