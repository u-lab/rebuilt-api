<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Services\Users\ReleaseService;
use Illuminate\Http\Request;

class ReleaseController extends Controller
{
    protected $_service;

    public function __construct(ReleaseService $service)
    {
        $this->_service = $service;
    }

    public function index()
    {
        return $this->_service->get_release();
    }
}
