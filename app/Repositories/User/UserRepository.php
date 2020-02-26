<?php

namespace App\Repositories\User;

use App\User;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @var \App\User
     */
    private $_user;

    public function __construct(User $user)
    {
        $this->_user = $user;
    }

    /**
     * Userの削除
     *
     * @param string $user_id
     * @return boolean|null
     * @throws \Exception
     */
    public function delete_user(string $user_id): ?bool
    {
        return $this->_user->delete($user_id);
    }

    /**
     * 名前によってユーザーデータを取得する
     *
     * @param string $user_name
     * @return \Illuminate\Database\Eloquent\Model|static
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function get_user_by_name(string $user_name)
    {
        $user = $this->_user->whereName($user_name)->firstOrFail();
        return $user;
    }

    /**
     * user_idを取得する
     *
     * @param string $user_name
     * @return integer
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function get_user_id(string $user_name): int
    {
        return $this->get_user_by_name($user_name)->id;
    }
}
