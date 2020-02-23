<?php

namespace App\Repositories\User;

use App\Models\UserProfile;
use App\User;
use App\Repositories\User\UserProfileRepositoryInterface;

class UserProfileRepository implements UserProfileRepositoryInterface
{
    /**
     * IDによってユーザープロフィールを取得
     *
     * @param string $id
     * @return void
     */
    public function get_user_profile_by_id(string $id)
    {
        return UserProfile::find($id);
    }
}
