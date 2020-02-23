<?php

namespace App\Repositories\User;

use App\Models\UserProfile;

interface UserProfileRepositoryInterface
{
    /**
     * IDによってユーザープロフィールを取得
     *
     * @param string $id
     * @return void
     */
    public function get_user_profile_by_id(string $id);
}
