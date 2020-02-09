<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Services\Pages\StorageService;
use App\Http\Requests\Pages\AllStorageRequest;
use App\Http\Requests\Pages\IndexStorageRequest;
use App\Http\Requests\Pages\ShowStorageRequest;

class StorageController extends Controller
{
    /**
     * @var \App\Services\Pages\StorageService
     */
    private $_service;

    public function __construct(StorageService $service)
    {
        $this->_service = $service;
    }

    /**
     * 全ユーザーのストレージを一括取得
     *
     * @param \App\Http\Requests\Pages\AllStorageRequest $request
     * @return mixed
     * @todo 戻り値が未定義
     */
    public function all(AllStorageRequest $request)
    {
        return $this->_service->get_all_users_storage($request);
    }

    /**
     * あるユーザーのストレージ内を一括取得
     *
     * @param \App\Http\Requests\Pages\IndexStorageRequest $request
     * @param string $user
     * @return mixed
     * @todo 戻り値が未定義
     */
    public function index(IndexStorageRequest $request, string $user)
    {
        return $this->_service->get_user_all_storages($request);
    }

    /**
     * あるユーザーの指定されたストレージを取得
     *
     * @param \App\Http\Requests\Pages\ShowStorageRequest $request
     * @param string $user
     * @param string $storage_id
     * @return mixed
     * @todo 戻り値が未定義
     */
    public function show(ShowStorageRequest $request, string $user, string $storage_id)
    {
        return $this->_service->get_user_storage($request);
    }
}
