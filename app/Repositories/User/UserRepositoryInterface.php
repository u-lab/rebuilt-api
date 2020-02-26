<?php

namespace App\Repositories\User;

interface UserRepositoryInterface
{
    /**
     * Userの削除
     *
     * @param string $user_id
     * @return boolean|null
     * @throws \Exception
     */
    public function delete_user(string $user_id): ?bool;

    /**
     * 名前によってユーザーデータを取得する
     *
     * @param string $user_name
     * @return \Illuminate\Database\Eloquent\Model|static
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function get_user_by_name(string $user_name);

    /**
     * user_idを取得する
     *
     * @param string $user_name
     * @return integer
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function get_user_id(string $user_name): int;
}
