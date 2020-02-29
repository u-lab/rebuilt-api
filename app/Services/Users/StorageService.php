<?php

namespace App\Services\Users;

use InvalidArgumentException;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Users\IndexStorageRequest;
use App\Http\Requests\Users\UpdateStorageRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\Storage\StorageRepositoryInterface;
use App\Http\Resources\Users\Storage as StorageResource;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

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
    public function get_storage($request, string $storage_id)
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
        if ($request->hasFile('eyecatch_image') && $request->file('eyecatch_image')->isValid()) {
            $eyecatch_filename = $request->file('eyecatch_image')->store('/storages/eyecatch', 'public');
            $eyecatch_image_url = Storage::disk('public')->url($eyecatch_filename);
            if (isset($eyecatch_image_url)) {
                $request_except[] = 'eyecatch_image_url';
            }
        }

        // 作品の保存
        if ($request->hasFile('storage') && $request->file('storage')->isValid()) {
            $storage_filename = $request->file('storage')->store('/storages/storage', 'public');
            $storage_url = Storage::disk('public')->url($storage_filename);
            if (isset($storage_url)) {
                $request_except[] = 'storage_url';
            }
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
}
