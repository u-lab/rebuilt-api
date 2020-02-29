<?php

namespace App\Services\Users;

use InvalidArgumentException;
use App\Http\Requests\Users\IndexStorageRequest;
use App\Http\Requests\Users\UpdateStorageRequest;
use App\Repositories\Storage\StorageRepositoryInterface;
use App\Http\Resources\Users\Storage as StorageResource;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;

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
     * 作品の内容を更新する
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
        $eyecatch_filename = $request->file('eyecatch_image')->store('/storages/eyecatch', 'public');
        $eyecatch_image_url = Storage::disk('public')->url($eyecatch_filename);
        if (empty($eyecatch_image_url)) {
            $request_except[] = 'eyecatch_image_url';
        }

        // 作品の保存
        $storage_filename = $request->file('storage')->store('/storages/storage', 'public');
        $storage_url = Storage::disk('public')->url($storage_filename);
        if (empty($storage_url)) {
            $request_except[] = 'storage_url';
        }

        // DBに保存するデータの作成
        $inserts = isset($request_except) ?
                    $request->except($request_except) : $request->all();

        return $this->_storageRepository
                    ->updateOrCreate($inserts, $user->id, $storage_id);
    }
}
