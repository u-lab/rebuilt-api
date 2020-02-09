<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Services\Pages\ProfileService;
use App\Http\Requests\Pages\IndexProfileRequest;

class ProfileController extends Controller
{
    /**
     * @var \App\Services\Pages\ProfileService
     */
    private $_service;

    public function __construct(ProfileService $service)
    {
        $this->_service = $service;
    }

    /**
     * すべてのユーザーのプロフィールを一括取得
     *
     * @param \App\Http\Requests\Pages\IndexProfileRequest $request
     * @return mixed
     * @todo 戻り値が未定義
     */
    public function index(IndexProfileRequest $request)
    {
        return $this->_service->get_all_users_profile($request);
    }
}
