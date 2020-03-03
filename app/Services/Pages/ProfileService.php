<?php

namespace App\Services\Pages;

use Log;
use InvalidArgumentException;
use App\Http\Requests\Pages\IndexProfileRequest;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProfileService
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
     * すべてのユーザーのプロフィールを取得する
     *
     * @param IndexProfileRequest $request
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function get_all_users_profile(IndexProfileRequest $request): LengthAwarePaginator
    {
        try {
            $user_profiles = $this->_userRepository->get_user_profiles_by_pagination();
            return $user_profiles;
        } catch (InvalidArgumentException $e) {
            Log::error($e);
            return abort(response()->json(['message' => $e->getMessage()]), 404);
        }
    }
}
