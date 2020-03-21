<?php

namespace App\Repositories\User;

use App\Models\UserCareer;
use App\Repositories\User\UserCareerRepositoryInterface;

class UserCareerRepository implements UserCareerRepositoryInterface
{
    /**
     * @var \App\Models\UserCareer
     */
    protected $_userCareer;

    public function __construct(UserCareer $userCareer)
    {
        $this->_userCareer = $userCareer;
    }

    /**
     * UserCareerを更新か作成する
     *
     * @param array $inserts
     * @param integer $user_id
     * @param integer $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function updateOrCreate(array $inserts, int $user_id, int $id)
    {
        $userCareer = $this->_userCareer
            ->updateOrCreate(
                [ 'id' => $id, 'user_id' => $user_id ],
                $inserts
            );

        return $userCareer;
    }
}
