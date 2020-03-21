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
     * @param integer $storage_id
     * @param integer|null $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function updateOrCreate(array $inserts, int $storage_id, ?int $id = null)
    {
        $attributes = ['storage_id' => $storage_id];
        if (isset($id)) {
            $attributes['id'] = $id;
        }

        $storage = $this->_storageFile
            ->updateOrCreate(
                $attributes,
                $inserts
            );

        return $storage;
    }
}
