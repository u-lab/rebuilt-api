<?php

namespace App\Repositories\User;

use App\User;

interface UserRepositoryInterface
{
    public function get_user_page(string $user_name): array;
}
