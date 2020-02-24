<?php

namespace App\Repositories\User;

use App\Models\UserProfile;
use App\Repositories\User\UserProfileRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UserProfileRepository implements UserProfileRepositoryInterface
{
    /**
     * @var UserProfile
     */
    private $_userProfile;

    public function __construct(UserProfile $userProfile)
    {
        $this->_userProfile = $userProfile;
    }

    /**
     * UserIDによってユーザープロフィールを取得
     *
     * @param string $user_id
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|static|static[]
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function get_user_profile_by_id(string $user_id)
    {
        return UserProfile::findOrFail($user_id);
    }

    /**
     * ユーザープロフィール一覧をページネーションでとってくる
     *
     * @param integer $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     * @throws \InvalidArgumentException
     */
    public function get_user_profiles_by_pagination(int $perPage = 10): LengthAwarePaginator
    {
        return $this->_userProfile
                    ->with('user')
                    ->paginate($perPage);
    }
}
