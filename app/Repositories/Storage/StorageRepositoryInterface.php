<?php

namespace App\Repositories\Storage;

interface StorageRepositoryInterface
{
    /**
     * 作品を取得する
     *
     * @param integer $user_id
     * @param string $storage_id
     * @return void
     */
    public function get_storage(int $user_id, string $storage_id);

    /**
     * ユーザーIDを用いないで作品を取得する
     *
     * @param string $storage_id
     * @return void
     */
    public function get_storage_no_user_id(string $storage_id);

    /**
     * 作品の内容を更新する
     *
     * @param array $inserts
     * @param integer $user_id
     * @param string $storage_id
     * @return void
     */
    public function update(array $inserts, int $user_id, string $storage_id);
}
