<?php

namespace App\Repositories\User;

use App\Models\UserProfile;

interface UserProfileRepositoryInterface
{
    /**
     * UserIDによってユーザープロフィールを取得
     *
     * @param string $user_id
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|static|static[]
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function get_user_profile_by_id(string $user_id);
}
