<?php

namespace App\Repositories\Storage;

use App\Models\Storage;
use App\Repositories\Storage\StorageRepositoryInterface;

class StorageRepository implements StorageRepositoryInterface
{
    /**
     * @var \App\Models\Storage
     */
    private $_storage;

    public function __construct(Storage $storage)
    {
        $this->_storage = $storage;
    }

    /**
     * 作品を取得する
     *
     * @param integer $user_id
     * @param string $storage_id
     * @return mixed
     */
    public function get_storage(int $user_id, string $storage_id)
    {
        $storage = $this->_storage->where('user_id', '=', $user_id)
            ->where('storage_id', '=', $storage_id)
            ->first();

        return $storage;
    }

    /**
     * ユーザーIDを用いないで作品を取得する
     *
     * @param string $storage_id
     * @return mixed
     */
    public function get_storage_no_user_id(string $storage_id)
    {
        $storage = $this->_storage
            ->where('storage_id', '=', $storage_id)
            ->first();

        return $storage;
    }

    /**
     * 作品の内容を更新する
     *
     * @param array $inserts
     * @param integer $user_id
     * @param string $storage_id
     * @return mixed
     */
    public function update(array $inserts, int $user_id, string $storage_id)
    {
        $storage = $this->_storage
            ->where('user_id', '=', $user_id)
            ->where('storage_id', '=', $storage_id)
            ->update($inserts);

        return true;
    }
}
