<?php

namespace App\Repositories\Storage;

interface StorageFileRepositoryInterface
{
    /**
     * StorageFileを更新か作成する
     *
     * @param array $inserts
     * @param integer $storage_id
     * @param integer|null $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function updateOrCreate(array $inserts, int $storage_id, ?int $id = null);
}
