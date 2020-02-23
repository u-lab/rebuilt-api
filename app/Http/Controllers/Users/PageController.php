<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Services\Users\PageService;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    /**
     * @var \App\Services\Users\PageService
     */

    private $_service;

    public function __construct(PageService $service)
    {
        $this->_service = $service;
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        return $this->_service->get_user_page($request);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }
}
