<?php

namespace App\Repositories\User;

use App\Models\UserProfile;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

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

    /**
     * ユーザープロフィールをUpdateかCreateする
     *
     * @param string $user_id
     * @param array $insert
     * @return \Illuminate\Database\Eloquent\Model|static
     */
    public function updateOrCreate_user_profile(string $user_id, array $insert);
}
