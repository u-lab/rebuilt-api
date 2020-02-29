<?php

namespace App\Services\Users;

use Exception;
use App\Http\Requests\Users\DestroyUserRequest;
use App\Repositories\User\UserRepositoryInterface;

class UserService
{
    /**
     * @var \App\Repositories\User\UserRepositoryInterface
     */
    private $_userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->_userRepository = $userRepository;
    }

    /**
     * User(自分)を削除する
     *
     * @param \App\Http\Requests\Users\DestroyUserRequest $request
     * @return mixed
     */
    public function delete_user(DestroyUserRequest $request)
    {
        try {
            $user = $request->user();
            return $this->_userRepository->delete_user($user->id);
        } catch (Exception $e) {
            return abort(response()->json(['message' => $e->getMessage()]), 500);
        }
    }
}
