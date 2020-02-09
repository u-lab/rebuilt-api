<?php

namespace App\Http\Controllers\Pages;

use App\Services\Pages\PageService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Pages\ShowPageRequest;

class PageController extends Controller
{
    /**
     * @var \App\Services\Pages\PageService
     */
    private $_service;

    public function __construct(PageService $service)
    {
        $this->_service = $service;
    }

    /**
     * ユーザーのプロフィールを取得する
     *
     * @param \App\Http\Requests\Pages\ShowPageRequest $request
     * @param string $user
     * @return mixed
     * @todo 戻り値が未定義
     */
    public function show(ShowPageRequest $request, string $user)
    {
        return $this->_service->get_user_page($request, $user);
    }
}
