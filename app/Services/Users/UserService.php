<?php

namespace App\Services\Users;

use Exception;
use App\Exceptions\Users\NonDeleteUser;
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
            $success = $this->_userRepository->delete_user($user->id);
            if ($success) {
                return abort(response()->json(['message' => 'success']), 200);
            }
            throw new NonDeleteUser();
        } catch (Exception $e) {
            return abort(response()->json(['message' => $e->getMessage()]), 500);
        } catch (NonDeleteUser $e) {
            return abort(response()->json(['message' => $e->getMessage()]), 500);
        }
    }
}
