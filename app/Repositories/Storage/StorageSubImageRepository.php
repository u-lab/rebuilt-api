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
     * @param integer $storage_id
     * @param integer|null $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function updateOrCreate(array $inserts, int $storage_id, ?string $id = null)
    {
        $attributes = ['storage_id' => $storage_id];
        if (isset($id)) {
            $attributes['id'] = $id;
        }

        $storage = $this->_storageSubImage
            ->updateOrCreate(
                $attributes,
                $inserts
            );

        return $storage;
    }
}
