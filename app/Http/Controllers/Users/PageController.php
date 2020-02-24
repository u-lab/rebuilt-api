<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Services\Users\PageService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Users\ShowPageRequest;

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
     * @param ShowPageRequest $request
     * @return \Illuminate\Http\Response
     */
    public function show(ShowPageRequest $request)
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
