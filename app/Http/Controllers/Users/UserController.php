<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Services\Users\UserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Users\DestroyUserRequest;

class UserController extends Controller
{
    private $_service;

    public function __construct(UserService $service)
    {
        $this->_service = $service;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Http\Requests\Users\DestroyUserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(DestroyUserRequest $request)
    {
        return $this->_service->delete_user($request);
    }
}
