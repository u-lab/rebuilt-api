<?php

namespace App\Services\Storages;

use App\Repositories\Storage\StorageSubImageRepositoryInterface;
use App\Services\FileSystem\ImageService;

class StoreSubImageService
{
    protected $_storageSubImageRepository;

    /**
     * @var \App\Services\FileSystem\ImageService
     */
    protected $_service;

    public function __construct(
        StorageSubImageRepositoryInterface $storageSubImageRepositoryInterface,
        ImageService $service
    ) {
        $this->_storageSubImageRepository = $storageSubImageRepositoryInterface;
        $this->_service = $service;
    }

    public function store(int $storage_id, $request)
    {
        $image_ids = [];
        foreach ($request->file('storage_sub_images') as $file) {
            $image_id = $this->_service->store($file, 'storage_sub_images', '/storages/sub_image/');
            $image_ids[] = $image_id;
        }

        foreach ($image_ids as $image_id) {
            $this->_storageSubImageRepository
                ->updateOrCreate(
                    ['image_id' => $image_id, 'storage_id' => $storage_id],
                    $storage_id,
                    $image_id
                );
        }
    }
}
