<?php

namespace App\Repositories\User;

interface UserReleaseRepositoryInterface
{
    public function create(int $user_id, int $release_id);
}
