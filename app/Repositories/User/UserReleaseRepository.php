<?php

namespace App\Repositories\User;

use App\Models\UserRelease;
use App\Repositories\User\UserReleaseRepositoryInterface;

class UserReleaseRepository implements UserReleaseRepositoryInterface
{
    /**
     * @var \App\Models\UserRelease
     */
    protected $_userRelease;

    public function __construct(UserRelease $userRelease)
    {
        $this->_userRelease = $userRelease;
    }

    /**
     * UserReleaseの作成
     *
     * @param integer $user_id
     * @param integer $release_id
     * @return App\Models\UserRelease
     */
    public function create(int $user_id, int $release_id)
    {
        return $this->_userRelease->create(['user_id' => $user_id, 'release_id' => $release_id]);
    }

    /**
     * UserCareerを更新か作成する
     *
     * @param array $inserts
     * @param integer $user_id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function updateOrCreate(array $inserts, int $user_id)
    {
        $userRelease = $this->_userRelease
            ->updateOrCreate(
                [ 'user_id' => $user_id ],
                $inserts
            );

        return $userRelease;
    }
}
