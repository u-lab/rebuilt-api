<?php

namespace App\Services\Users;

use App\Facades\MyStorage;
use InvalidArgumentException;
use App\Http\Requests\Users\ShowStorageRequest;
use App\Http\Requests\Users\IndexStorageRequest;
use App\Http\Requests\Users\StoreStorageRequest;
use App\Http\Requests\Users\UpdateStorageRequest;
use App\Http\Requests\Users\DestroyStorageRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\Storage\StorageRepositoryInterface;
use App\Http\Resources\Users\Storage as StorageResource;
use App\Services\FileSystemService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class StorageService
{
    /**
     * @var \App\Repositories\Storage\StorageRepositoryInterface
     */
    private $_storageRepository;

    private $_fileSystemService;

    public function __construct(
        StorageRepositoryInterface $storageRepository,
        FileSystemService $fileSystemService
    ) {
        $this->_storageRepository = $storageRepository;
        $this->_fileSystemService = $fileSystemService;
    }

    /**
     * 作品を取得する
     *
     * @param \App\Http\Requests\Users\ShowStorageRequest $request
     * @param string $storage_id
     * @return void
     */
    public function get_storage(ShowStorageRequest $request, string $storage_id)
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
     * @return LengthAwarePaginator
     */
    public function get_user_all_storages(IndexStorageRequest $request): LengthAwarePaginator
    {
        try {
            $user = $request->user();

            return $this->_storageRepository->get_user_all_storages($user->id);
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
        $request_except = ['user_id', 'storage_id'];
        $user_id = $user->id;
        $storage_id = MyStorage::generateID();

        // アイキャッチ画像の保存
        $eyecatch_image_id = $this->_fileSystemService
                                ->store_requestImage($request, 'eyecatch_image', '/storages/eyecatch');
        if (isset($eyecatch_image_id)) {
            $request_except[] = 'eyecatch_image_id';
        }

        // 作品の保存
        $storage_url = $this->_fileSystemService
                            ->store_requestStorage($request, 'storage', '/storages/storage/');
        if (isset($storage_url)) {
            $request_except[] = 'storage_url';
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

        return new StorageResource($this->_storageRepository->create_storage($inserts));
    }

    /**
     * 作品の内容を更新する
     * この関数内ではfileのURLのキー名と変数名を一致させておくこと。
     *
     * @param UpdateStorageRequest $request
     * @param string $storage_id
     * @return mixed
     */
    public function update(UpdateStorageRequest $request, string $storage_id)
    {
        $user = $request->user();
        // requestでexceptを指定するもの。
        $request_except = [];

        // アイキャッチ画像の保存
        $eyecatch_image_id = $this->_fileSystemService
                                ->store_requestImage($request, 'eyecatch_image', '/storages/eyecatch/');
        if (isset($eyecatch_image_id)) {
            $request_except[] = 'eyecatch_image_id';
        }

        // 作品の保存
        $storage_url = $this->_fileSystemService
                            ->store_requestStorage($request, 'storage', '/storages/storage/');
        if (isset($storage_url)) {
            $request_except[] = 'storage_url';
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
        return $this->_storageRepository
                    ->updateOrCreate($inserts, $user->id, $storage_id);
    }

    /**
     * Storageを削除する
     *
     * @param DestroyStorageRequest $request
     * @param string $storage_id
     * @return boolean|null
     */
    public function destory(DestroyStorageRequest $request, string $storage_id): ?bool
    {
        return $this->_storageRepository->destroy_storage($storage_id);
    }
}
