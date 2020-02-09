<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Services\BreadcrumbsService;
use App\Http\Requests\BreadcrumbsFormRequest;

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

    public function index(BreadcrumbsFormRequest $request): JsonResponse
    {
        return $this->_service->render($request);
    }
}
