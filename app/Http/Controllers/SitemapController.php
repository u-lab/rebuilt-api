<?php

namespace App\Http\Controllers;

use App\Services\SitemapService;
use Illuminate\Http\JsonResponse;

class SitemapController extends Controller
{
    /**
     * @var \App\Services\SitemapService
     */
    private $_service;

    public function __construct(SitemapService $service)
    {
        $this->_service = $service;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->_service->generate();
    }
}
