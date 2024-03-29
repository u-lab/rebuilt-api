<?php

namespace App\Repositories\Storage;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface StorageRepositoryInterface
{
    /**
     * Storageを追加する
     *
     * @param array $inserts
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create_storage(array $inserts);

    /**
     * storageのソフトデリート
     *
     * @param string $storage_id
     * @return boolean|null
     */
    public function destroy_storage(string $storage_id): ?bool;

    /**
     * すべての作品を取得する
     *
     * @return mixed
     */
    public function get_all_storages_with_user();

    /**
     * 全ユーザーの全作品を取得する
     *
     * @param integer $per_page
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     * @throws \InvalidArgumentException
     */
    public function get_all_storages(int $per_page = 15): LengthAwarePaginator;

    /**
     * 作品を取得する
     *
     * @param integer $user_id
     * @param string $storage_id
     * @return \Illuminate\Database\Eloquent\Model|static
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function get_storage(int $user_id, string $storage_id);

    /**
     * ユーザーIDを用いないで作品を取得する
     *
     * @param string $storage_id
     * @return \Illuminate\Database\Eloquent\Model|static
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function get_storage_no_user_id(string $storage_id);

    /**
     * ユーザーの全作品を取得する
     *
     * @param integer $user_id
     * @param integer $per_page
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     * @throws \InvalidArgumentException
     */
    public function get_user_all_storages(int $user_id, int $per_page = 15): LengthAwarePaginator;

    /**
     * ユーザーIDを用いないで作品を取得する
     *
     * @param string $storage_id
     * @return \Illuminate\Database\Eloquent\Model|static
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function get_storage_no_user_id_all_release(string $storage_id);

    /**
      * 作品の内容を更新か作成する
      *
      * @param array $inserts
      * @param integer $user_id
      * @param string $storage_id
      * @return \Illuminate\Database\Eloquent\Model|static
      */
    public function updateOrCreate(array $inserts, int $user_id, string $storage_id);
}
