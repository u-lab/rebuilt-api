<?php

namespace App\Services\Users;

use App\Facades\MyStorage;
use InvalidArgumentException;
use App\Exceptions\Image\FailedUploadImage;
use App\Exceptions\Users\NonDeleteStorage;
use App\Http\Requests\Users\ShowStorageRequest;
use App\Http\Requests\Users\IndexStorageRequest;
use App\Http\Requests\Users\StoreStorageRequest;
use App\Http\Requests\Users\UpdateStorageRequest;
use App\Http\Requests\Users\DestroyStorageRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\Storage\StorageRepositoryInterface;
use App\Http\Resources\Users\Storage as StorageResource;
use App\Http\Resources\Users\StoragePagination as StoragePaginationResource;
use App\Services\FileSystemService;
use App\Services\Storages\StoreSubImageService;

class StorageService
{
    /**
     * @var \App\Repositories\Storage\StorageRepositoryInterface
     */
    private $_storageRepository;

    private $_storeSubImageService;

    private $_fileSystemService;

    public function __construct(
        StorageRepositoryInterface $storageRepository,
        StoreSubImageService $storeSubImageService,
        FileSystemService $fileSystemService
    ) {
        $this->_storageRepository = $storageRepository;
        $this->_storeSubImageService = $storeSubImageService;
        $this->_fileSystemService = $fileSystemService;
    }

    /**
     * 作品を取得する
     *
     * @param \App\Http\Requests\Users\ShowStorageRequest $request
     * @param string $storage_id
     * @return StorageResource
     */
    public function get_storage(ShowStorageRequest $request, string $storage_id): StorageResource
    {
        $user = $request->user();

        try {
            $stroage = $this->_storageRepository->get_storage($user->id, $storage_id);
            return new StorageResource($stroage);
        } catch (ModelNotFoundException $e) {
            return abort(response()->json(['message' => $e->getMessage()]), 404);
        }
    }

    /**
     * ユーザーの全作品を取得する
     *
     * @param IndexStorageRequest $request
     * @return \StoragePaginationResource
     */
    public function get_user_all_storages(IndexStorageRequest $request): StoragePaginationResource
    {
        try {
            $user = $request->user();
            $per_page = $request->query('per_page') ?? 15;

            $pagination = $this->_storageRepository->get_user_all_storages($user->id, $per_page);
            return new StoragePaginationResource($pagination);
        } catch (InvalidArgumentException $e) {
            return abort(response()->json(['message' => $e->getMessage()]), 404);
        }
    }

    /**
     * 作品をDBに保存する
     *
     * @param StoreStorageRequest $request
     * @return StorageResource
     */
    public function store(StoreStorageRequest $request): StorageResource
    {
        $user = $request->user();
        // requestでexceptを指定するもの。
        $request_except = ['user_id', 'storage_id', 'release_id'];
        $user_id = $user->id;
        $storage_id = MyStorage::generateID();
        $release_id = 1;

        // アイキャッチ画像の保存
        $eyecatch_image_id = $this->_fileSystemService
                                ->store_requestImage($request, 'eyecatch_image', '/storages/eyecatch');
        if (isset($eyecatch_image_id)) {
            $request_except[] = 'eyecatch_image_id';
        }

        if (isset($request->storage_sub_images)) {
            $this->_storeSubImageService->store($storage_id, $request->storage_sub_images);
            $request_except[] = 'storage_sub_images';
        }

        // DBに保存するデータの作成
        if (isset($request_except)) {
            $inserts = $request->except($request_except);

            // $inserts['hoge'] = $hoge 可変変数の使用をしている。
            foreach ($request_except as $insert_data) {
                $inserts[$insert_data] = ${$insert_data};
            }
        }

        // 挿入するデータが何もなかったら、$request->allする
        $inserts = $inserts ?? $request->all();

        $storage = $this->_storageRepository->create_storage($inserts);

        // 作品の保存
        $this->_fileSystemService
                            ->store_requestStorage($request, $storage->id, 'storage', '/storages/storage/');


        return new StorageResource($storage);
    }

    /**
     * 作品の内容を更新する
     * この関数内ではfileのURLのキー名と変数名を一致させておくこと。
     *
     * @param UpdateStorageRequest $request
     * @param string $storage_id
     * @return mixed
     */
    public function update(UpdateStorageRequest $request, string $storage_id): StorageResource
    {
        $user = $request->user();
        // requestでexceptを指定するもの。
        $request_except = ['release_id'];
        $release_id = 1;

        // アイキャッチ画像の保存
        try {
            $eyecatch_image_id = $this->_fileSystemService
                                    ->store_requestImage($request, 'eyecatch_image', '/storages/eyecatch/');
            if (isset($eyecatch_image_id)) {
                $request_except[] = 'eyecatch_image_id';
            }
        } catch (FailedUploadImage $e) {
            \Log::error($e);
            return response()->json(['message' => $e->getMessage()], 500);
        }

        if (isset($request->storage_sub_images)) {
            $this->_storeSubImageService->store($storage_id, $request->storage_sub_images);
            $request_except[] = 'storage_sub_images';
        }

        // DBに保存するデータの作成
        if (isset($request_except)) {
            $inserts = $request->except($request_except);

            // $inserts['hoge'] = $hoge 可変変数の使用をしている。
            foreach ($request_except as $insert_data) {
                $inserts[$insert_data] = ${$insert_data};
            }
        }

        // 挿入するデータが何もなかったら、$request->allする
        $inserts = $inserts ?? $request->all();

        // DBの更新
        $storage = $this->_storageRepository
                    ->updateOrCreate($inserts, $user->id, $storage_id);

        // 作品の保存
        $this->_fileSystemService
                            ->store_requestStorage($request, $storage->id, 'storage', '/storages/storage/');


        return new StorageResource($storage);
    }

    /**
     * Storageを削除する
     *
     * @param DestroyStorageRequest $request
     * @param string $storage_id
     * @return mixed
     */
    public function destory(DestroyStorageRequest $request, string $storage_id)
    {
        try {
            $success = $this->_storageRepository->destroy_storage($storage_id);
            if ($success) {
                return abort(response()->json(['message' => $success]), 200);
            }
            throw new NonDeleteStorage();
        } catch (NonDeleteStorage $e) {
            return abort(response()->json(['message' => $e->getMessage()]), 500);
        }
    }
}
