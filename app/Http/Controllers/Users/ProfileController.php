<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Users\ProfileService;
use App\Http\Requests\Users\UpdateProfileRequest;

class ProfileController extends Controller
{
    /**
     * @var \App\Services\Users\ProfileService
     */
    private $_service;

    public function __construct(ProfileService $service)
    {
        $this->_service = $service;
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        return $this->_service->get_user_profile($request);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Users\UpdateProfileRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfileRequest $request)
    {
        return $this->_service->update_profile($request);
    }
}
