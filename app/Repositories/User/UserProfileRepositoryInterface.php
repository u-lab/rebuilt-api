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
     * ユーザープロフィール一覧をページネーションでとってくる
     *
     * @param integer $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     * @throws \InvalidArgumentException
     */
    public function get_user_profiles_by_pagination(int $perPage = 10): LengthAwarePaginator;

    /**
     * ユーザープロフィールをUpdateかCreateする
     *
     * @param string $user_id
     * @param array $insert
     * @return \Illuminate\Database\Eloquent\Model|static
     */
    public function updateOrCreate_user_profile(string $user_id, array $insert);
}
