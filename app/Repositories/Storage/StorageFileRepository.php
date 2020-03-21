<?php

namespace App\Repositories\Storage;

use App\Models\StorageFile;
use App\Repositories\Storage\StorageFileRepositoryInterface;

class StorageFileRepository implements StorageFileRepositoryInterface
{
    /**
     * @var \App\Models\StorageFile
     */
    protected $_storageFile;

    public function __construct(StorageFile $storageFile)
    {
        $this->_storageFile = $storageFile;
    }

    /**
     * StorageFileを更新か作成する
     *
     * @param array $inserts
     * @param string $storage_id
     * @param integer $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function updateOrCreate(array $inserts, string $storage_id, int $id)
    {
        $storage = $this->_storageFile
            ->updateOrCreate(
                [ 'id' => $id, 'storage_id' => $storage_id ],
                $inserts
            );

        return $storage;
    }
}
