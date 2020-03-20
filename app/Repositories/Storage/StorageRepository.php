<?php

namespace App\Repositories\Storage;

use App\Models\Storage;
use App\Repositories\Storage\StorageRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class StorageRepository implements StorageRepositoryInterface
{
    /**
     * @var \App\Models\Storage
     */
    private $_storage;

    public function __construct(Storage $storage)
    {
        $this->_storage = $storage;
    }

    /**
     * Storageを追加する
     *
     * @param array $inserts
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create_storage(array $inserts)
    {
        return $this->_storage->create($inserts);
    }

    /**
     * storageのソフトデリート
     *
     * @param string $storage_id
     * @return boolean|null
     */
    public function destroy_storage(string $storage_id): ?bool
    {
        return $this->_storage->whereStorageId($storage_id)->delete();
    }

    /**
     * すべての作品を取得する
     *
     * @return mixed
     */
    public function get_all_storages_with_user()
    {
        return $this->_storage->with('user')->get()->all();
    }

    /**
     * 全ユーザーの全作品を取得する
     *
     * @param integer $per_page
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     * @throws \InvalidArgumentException
     */
    public function get_all_storages(int $per_page = 15): LengthAwarePaginator
    {
        return $this->_storage->with(['user', 'eyecatch_image'])->paginate($per_page);
    }

    /**
     * 作品を取得する
     *
     * @param integer $user_id
     * @param string $storage_id
     * @return \Illuminate\Database\Eloquent\Model|static
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function get_storage(int $user_id, string $storage_id)
    {
        $storage = $this->_storage->where('user_id', '=', $user_id)
            ->where('storage_id', '=', $storage_id)
            ->firstOrFail();

        return $storage;
    }

    /**
     * ユーザーIDを用いないで作品を取得する
     *
     * @param string $storage_id
     * @return \Illuminate\Database\Eloquent\Model|static
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function get_storage_no_user_id(string $storage_id)
    {
        $storage = $this->_storage
            ->where('storage_id', '=', $storage_id)
            ->with('user')
            ->firstOrFail();

        return $storage;
    }

    /**
     * ユーザーの全作品を取得する
     *
     * @param integer $user_id
     * @param integer $per_page
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     * @throws \InvalidArgumentException
     */
    public function get_user_all_storages(int $user_id, int $per_page = 15): LengthAwarePaginator
    {
        return $this->_storage
                ->with('eyecatch_image')
                ->whereUserId($user_id)
                ->orderBy('updated_at', 'desc')
                ->paginate($per_page);
    }

    /**
     * 作品の内容を更新か作成する
     *
     * @param array $inserts
     * @param integer $user_id
     * @param string $storage_id
     * @return \Illuminate\Database\Eloquent\Model|static
     */
    public function updateOrCreate(array $inserts, int $user_id, string $storage_id)
    {
        $storage = $this->_storage
            ->updateOrCreate(
                [ 'user_id'    => $user_id, 'storage_id' => $storage_id ],
                $inserts
            );

        return $storage;
    }
}
