<?php

namespace App\Repositories\User;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

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
     * プロフィールとともにすべてのユーザーを取得する
     *
     * @return \Illuminate\Database\Eloquent\Model|static
     */
    public function get_all_user_with_profile();

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

    /**
     * ユーザープロフィール一覧をページネーションでとってくる
     *
     * @param integer $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     * @throws \InvalidArgumentException
     */
    public function get_user_profiles_by_pagination(int $perPage = 15): LengthAwarePaginator;
}
