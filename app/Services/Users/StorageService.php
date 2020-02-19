<?php

namespace App\Services\Users;

use App\Http\Requests\Users\UpdateStorageRequest;
use App\Repositories\Storage\StorageRepositoryInterface;
use App\Http\Resources\Users\Storage as StorageResource;

class StorageService
{
    /**
     * @var \App\Repositories\Storage\StorageRepositoryInterface
     */
    private $_storageRepository;

    public function __construct(StorageRepositoryInterface $storageRepository)
    {
        $this->_storageRepository = $storageRepository;
    }

    /**
     * 作品を取得する
     *
     * @param string $storage_id
     * @return void
     */
    public function get_storage(string $storage_id)
    {
        return new StorageResource($this->_storageRepository->get_storage_no_user_id($storage_id));
    }

    /**
     * 作品の内容を更新する
     *
     * @param UpdateStorageRequest $request
     * @param string $storage_id
     * @return void
     */
    public function update(UpdateStorageRequest $request, string $storage_id)
    {
        \Log::debug($request);
        $user_id = 1;
        $inserts = $request->data;
        return $this->_storageRepository->update($inserts, $user_id, $storage_id);
    }
}
