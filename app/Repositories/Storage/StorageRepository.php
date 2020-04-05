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
        $storage = $this->_storage
            ->with([
                'user',
                'user.user_role',
                'user.user_role.role',
                'user.user_info',
                'user.user_profile',
                'user.user_profile.icon_image',
                'user.user_profile.background_image',
                'user.user_profile.user_career',
                'user.user_portfolio',
                'user.user_portfolio.storage',
                'user.user_sns_accounts',
                'user.user_sns_accounts.sns_account',
                'user.user_release',
                'user.user_release.release',
                'eyecatch_image',
                'release',
                'storage_file',
                'storage_sub_image',
                'storage_sub_image.image'
            ])->whereHas('release', function ($query) {
                $query->where('release_level', '=', 100);
            })->whereHas('user.user_role.role', function ($query) {
                $query->where('role_level', '>=', 10);
            })->whereHas('user.user_release.release', function ($query) {
                $query->where('release_level', '=', 100);
            })->paginate($per_page);
        return $storage;
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
            ->with([
                'user',
                'user.user_sns_accounts',
                'eyecatch_image',
                'storage_file',
                'storage_sub_image'
            ])
            ->where('storage_id', '=', $storage_id)
            ->whereHas('release', function ($query) {
                $query->where('release_level', '=', 100);
            })->whereHas('user.user_role.role', function ($query) {
                $query->where('role_level', '>=', 10);
            })->whereHas('user.user_release.release', function ($query) {
                $query->where('release_level', '=', 100);
            })->firstOrFail();

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
            ->with([
            'user',
            'release',
            'eyecatch_image',
            'storage_file',
            'storage_sub_image'
            ])
            ->where('storage_id', '=', $storage_id)
            ->whereHas('release', function ($query) {
                $query->where('release_level', '=', 100);
            })->whereHas('user.user_role.role', function ($query) {
                $query->where('role_level', '>=', 10);
            })->whereHas('user.user_release.release', function ($query) {
                $query->where('release_level', '=', 100);
            })->firstOrFail();

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
        $storage = $this->_storage
                ->with(['release', 'eyecatch_image', 'storage_file', 'storage_sub_image'])
                ->whereUserId($user_id)
                ->whereHas('release', function ($query) { // banされているやつは除外
                    $query->where('release_level', '>', 5);
                })
                ->orderBy('updated_at', 'desc')
                ->paginate($per_page);
        return $storage;
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
