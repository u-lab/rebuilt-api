<?php

namespace App\Repositories\Storage;

use App\Models\StorageSubImage;
use App\Repositories\Storage\StorageSubImageRepositoryInterface;

class StorageSubImageRepository implements StorageSubImageRepositoryInterface
{
    /**
     * @var \App\Models\StorageSubImage
     */
    protected $_storageSubImage;

    public function __construct(StorageSubImage $storageSubImage)
    {
        $this->_storageSubImage = $storageSubImage;
    }

    /**
     * StorageSubImageを更新か作成する
     *
     * @param array $inserts
     * @param string $storage_id
     * @param integer $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function updateOrCreate(array $inserts, string $storage_id, int $id)
    {
        $storage = $this->_storageSubImage
            ->updateOrCreate(
                [ 'id' => $id, 'storage_id' => $storage_id ],
                $inserts
            );

        return $storage;
    }
}
