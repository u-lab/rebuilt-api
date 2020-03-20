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
     * @return mixed
     */
    public function index()
    {
        return $this->_service->generate();
    }
}
