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
        return $this->_userProfile
            ->with(['icon_image', 'background_image', 'user_career'])
            ->findOrFail($user_id);
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
                    ->orderBy('updated_at', 'desc')
                    ->paginate($perPage);
    }

    /**
     * ユーザープロフィールをUpdateかCreateする
     *
     * @param string $user_id
     * @param array $insert
     * @return \Illuminate\Database\Eloquent\Model|static
     */
    public function updateOrCreate_user_profile(string $user_id, array $insert)
    {
        return $this->_userProfile->updateOrCreate(
            [ 'user_id' => $user_id ],
            $insert
        );
    }
}
