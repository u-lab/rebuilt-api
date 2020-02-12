<?php

namespace App\Repositories\Storage;

interface StorageRepositoryInterface
{
    /**
     * 作品の取得
     *
     * @param integer $user_id
     * @param string $storage_id
     * @return void
     */
    public function get_storage(int $user_id, string $storage_id);

    /**
     * 作品の取得(storage_idのみ)
     *
     * @param string $storage_id
     * @return void
     */
    public function get_storage_no_user_id(string $storage_id);

    /**
     * ストレージの更新
     *
     * @param array $inserts
     * @param integer $user_id
     * @param string $storage_id
     * @return void
     */
    public function update(array $inserts, int $user_id, string $storage_id);
}
