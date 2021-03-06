<?php

namespace App\Services\Pages;

use App\Events\ModelNotFoundDetectionEvent;
use Log;
use InvalidArgumentException;
use App\Http\Requests\Pages\AllStorageRequest;
use App\Http\Requests\Pages\ShowStorageRequest;
use App\Http\Requests\Pages\IndexStorageRequest;
use App\Exceptions\Pages\UserIDNotEqualException;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Storage\StorageRepositoryInterface;
use App\Http\Resources\Pages\Storage as StorageResource;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Resources\Pages\StoragePagination as StoragePaginationResource;
use App\Http\Resources\Pages\AllStoragesPagination as AllStoragesPaginationResouce;
use Cache;

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
     * @return \AllStoragesPaginationResouce
     */
    public function get_all_users_storage(AllStorageRequest $request): AllStoragesPaginationResouce
    {
        try {
            $per_page = $request->query('per_page') ?? '15';
            $page = $request->query('page') ?? 1;

            $pagination = Cache::remember('users_sotrages_' . $per_page . '_page_' . $page, 60 * 10, function () use ($per_page) {
                $pagination = $this->_storageRepository->get_all_storages($per_page);
                return $pagination;
            });

            return new AllStoragesPaginationResouce($pagination);
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
    public function get_user_storage(ShowStorageRequest $request, string $user, string $storage_id): StorageResource
    {
        try {
            $login_user = $request->user();

            if ($login_user) {
                $storage = $this->_storageRepository->get_storage_no_user_id_all_release($storage_id);
                if (
                    strcmp($storage->user->name, $login_user->name) !== 0 ||
                    strcmp($storage->user->name, $user) !== 0
                ) {
                    throw new UserIDNotEqualException();
                }
            } else {
                $storage = $this->_storageRepository->get_storage_no_user_id($storage_id);
                if (strcmp($storage->user->name, $user) !== 0) {
                    throw new UserIDNotEqualException();
                }
            }

            return new StorageResource($storage);
        } catch (ModelNotFoundException $e) {
            event(new ModelNotFoundDetectionEvent('Model: ' . $e->getModel(). ' user: '. $user. ' storage_id:', $storage_id));
            return abort(response()->json(['message' => 'Page Not Found'], 404));
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
     * @return \StoragePaginationResource
     */
    public function get_user_all_storages(IndexStorageRequest $request, string $user): StoragePaginationResource
    {
        try {
            $per_page = $request->query('per_page') ?? '15';

            $user_id = $this->_userRepository->get_user_id($user);
            $pagination = Cache::remember(
                'get_user_all_storages_' . $user_id. 'per' . $per_page,
                30,
                function () use ($user_id, $per_page) {
                    $pagination = $this->_storageRepository->get_user_all_storages($user_id, $per_page);
                    return $pagination;
                }
            );
            return new StoragePaginationResource($pagination);
        } catch (InvalidArgumentException $e) {
            Log::error($e);
            return abort(response()->json(['message' => $e->getMessage()], 404));
        }
    }
}
