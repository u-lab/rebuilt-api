<?php

namespace App\Services\Pages;

use App\Models\Storage as StorageModel;
use App\Http\Requests\Pages\AllStorageRequest;
use App\Http\Requests\Pages\ShowStorageRequest;
use App\Http\Requests\Pages\IndexStorageRequest;
use App\Exceptions\Pages\UserIDNotEqualException;
use App\Repositories\User\UserRepositoryInterface;
use App\Http\Resources\PageStorage as PageStorageResource;
use App\Http\Resources\PageUserAllStorageCollection;
use App\Repositories\Storage\StorageRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use InvalidArgumentException;
use Log;

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
        try {
            return $this->_storageRepository->get_all_storages();
        } catch (InvalidArgumentException $e) {
            Log::error($e);
            return abort(response()->json(['message' => $e->getMessage()], 404));
        }
    }

    /**
     * userの作品を取得する
     *
     * @param ShowStorageRequest $request
     * @param string $user
     * @param string $storage_id
     * @return void
     */
    public function get_user_storage(ShowStorageRequest $request, string $user, string $storage_id): PageStorageResource
    {
        try {
            $storage = $this->_storageRepository->get_storage_no_user_id($storage_id);

            if (strcmp($storage->user->name, $user) !== 0) {
                throw new UserIDNotEqualException();
            }

            return new PageStorageResource($storage);
        } catch (ModelNotFoundException $e) {
            Log::error($e);
            $message = $storage_id . 'is not exsited.';

            return abort(response()->json(['message' => $message], 404));
        } catch (UserIDNotEqualException $e) {
            Log::error($e);
            $message = 'User ID と Storage IDの所有者が一致しませんでした。';

            return abort(response()->json(['message' => $message], 422));
        }
    }

    /**
     * Userの作品をすべて取得する
     *
     * @param IndexStorageRequest $request
     * @return void
     */
    public function get_user_all_storages(IndexStorageRequest $request)
    {
        try {
            return $this->_storageRepository->get_all_storages();
        } catch (InvalidArgumentException $e) {
            Log::error($e);
            return abort(response()->json(['message' => $e->getMessage()], 404));
        }
    }
}
