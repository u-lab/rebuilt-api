<?php

namespace App\Http\Controllers;

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

    public function index(BreadcrumbsFormRequest $request)
    {
        return $this->_service->render($request);
    }
}
