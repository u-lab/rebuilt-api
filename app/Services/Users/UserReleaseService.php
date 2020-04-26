<?php

namespace App\Services\Users;

use App\Repositories\User\UserReleaseRepositoryInterface;
use App\User;

class UserReleaseService
{
    protected $_userReleaseRepository;

    public function __construct(UserReleaseRepositoryInterface $userReleaseRepositoryInterface)
    {
        $this->_userReleaseRepository = $userReleaseRepositoryInterface;
    }

    public function create(User $user, int $release_id = 1)
    {
        $this->_userReleaseRepository->create($user->id, $release_id);
    }
}
