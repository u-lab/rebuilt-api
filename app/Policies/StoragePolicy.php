<?php

namespace App\Policies;

use App\Models\Storage;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StoragePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * 管理者 ( admin ) は指定したポリシーの全アクションを許可する
     *
     * @param User $user
     * @param mixed $ability
     * @return boolean
     */
    public function before(User $user, $ability): bool
    {
        return $user->user_role->role->is_admin();
    }

    /**
     * 指定されたユーザーが Storage を作成できるかを決める
     *
     * @param  \App\User  $user
     * @return bool
     */
    public function store(User $user): bool
    {
        return $user->user_role->role->is_normal();
    }

    /**
     * 指定されたユーザーが Storage を更新できるかを決める
     *
     * @param  \App\User  $user
     * @param  \App\Storage  $post
     * @return bool
     */
    public function update(User $user, Storage $storage): bool
    {
        return $user->id === $storage->user_id;
    }

    /**
     * 指定されたユーザーが Storage を削除できるかを決める
     *
     * @param  \App\User  $user
     * @param  \App\Storage  $post
     * @return bool
     */
    public function destroy(User $user, Storage $storage): bool
    {
        return $user->id === $storage->user_id;
    }
}
