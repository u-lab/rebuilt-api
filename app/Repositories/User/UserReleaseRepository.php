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
