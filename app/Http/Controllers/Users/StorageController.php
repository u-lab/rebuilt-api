<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Users\StorageService;
use App\Http\Requests\Users\ShowStorageRequest;
use App\Http\Requests\Users\IndexStorageRequest;
use App\Http\Requests\Users\StoreStorageRequest;
use App\Http\Requests\Users\UpdateStorageRequest;
use App\Http\Requests\Users\DestroyStorageRequest;

class StorageController extends Controller
{
    /**
     * @var \App\Services\Users\StorageService
     */
    private $_service;

    public function __construct(StorageService $service)
    {
        $this->_service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexStorageRequest $request)
    {
        return $this->_service->get_user_all_storages($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Users\StoreStorageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStorageRequest $request)
    {
        return $this->_service->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Http\Requests\Users\ShowStorageRequest $request
     * @param  string  $storage_id
     * @return \Illuminate\Http\Response
     */
    public function show(ShowStorageRequest $request, string $storage_id)
    {
        return $this->_service->get_storage($request, $storage_id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Users\UpdateStorageRequest  $request
     * @param  string  $storage_id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStorageRequest $request, string $storage_id)
    {
        return $this->_service->update($request, $storage_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $storage_id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DestroyStorageRequest $request, string $storage_id)
    {
        \Log::debug('dddestroy');
        return $this->_service->destory($request, $storage_id);
    }
}
