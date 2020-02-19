<?php

namespace App\Services\Pages;

use App\Models\Storage as StorageModel;
use App\Http\Requests\Pages\AllStorageRequest;
use App\Http\Requests\Pages\ShowStorageRequest;
use App\Http\Requests\Pages\IndexStorageRequest;
use App\Repositories\User\UserRepositoryInterface;
use App\Http\Resources\PageStorage as PageStorageResource;
use App\Http\Resources\PageUserAllStorageCollection;
use App\Repositories\Storage\StorageRepositoryInterface;

class StorageService
{
    /**
     * @var \App\Repositories\User\UserRepositoryInterface
     */
    private $_userRepository;
    /**
     * @var \App\Repositories\Storage\StorageRepositoryInterface
     */
    private $_storageRepository;

    public function __construct(
        UserRepositoryInterface $userRepository,
        StorageRepositoryInterface $storageRepository
    ) {
        $this->_userRepository = $userRepository;
        $this->_storageRepository = $storageRepository;
    }

    /**
     * すべてのユーザーの作品を取得する
     *
     * @param AllStorageRequest $request
     * @return void
     */
    public function get_all_users_storage(AllStorageRequest $request)
    {
    }

    /**
     * userのs作品を取得する
     *
     * @param ShowStorageRequest $request
     * @param string $user
     * @param string $storage_id
     * @return void
     */
    public function get_user_storage(ShowStorageRequest $request, string $user, string $storage_id)
    {
        $user_id = $this->_userRepository->get_user_id($user);
        $storage = $this->_storageRepository->get_storage($user_id, $storage_id);

        return new PageStorageResource($storage);
    }

    /**
     * Userの作品をすべて取得する
     *
     * @param IndexStorageRequest $request
     * @return void
     */
    public function get_user_all_storages(IndexStorageRequest $request)
    {
        return new PageUserAllStorageCollection(StorageModel::all());
    }
}
