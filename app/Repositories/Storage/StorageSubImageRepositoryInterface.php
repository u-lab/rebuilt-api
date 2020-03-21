<?php

namespace App\Repositories\Storage;

interface StorageSubImageRepositoryInterface
{
    /**
     * StorageSubImageを更新か作成する
     *
     * @param array $inserts
     * @param string $storage_id
     * @param integer $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function updateOrCreate(array $inserts, string $storage_id, int $id);
}
