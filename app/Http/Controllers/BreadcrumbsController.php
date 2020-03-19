<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Services\BreadcrumbsService;
use App\Http\Requests\BreadcrumbsRequest;

class BreadcrumbsController extends Controller
{
    /**
     * @var \App\Services\BreadcrumbsService
     */
    private $_service;

    public function __construct(BreadcrumbsService $service)
    {
        $this->_service = $service;
    }

    /**
     * パンくずリストの生成
     *
     * @param \App\Http\Requests\BreadcrumbsRequest $request
     * @return void
     */
    public function index(BreadcrumbsRequest $request)
    {
        return $this->_service->render($request);
    }
}
