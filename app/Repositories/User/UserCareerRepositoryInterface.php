<?php

namespace App\Repositories\User;

interface UserCareerRepositoryInterface
{
    /**
     * UserCareerを更新か作成する
     *
     * @param array $inserts
     * @param integer $user_id
     * @param integer|null $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function updateOrCreate(array $inserts, int $user_id, ?int $id = null);
}
