<?php

namespace App\Services\Pages;

use Log;
use InvalidArgumentException;
use App\Http\Requests\Pages\IndexProfileRequest;
use App\Repositories\User\UserRepositoryInterface;
use App\Http\Resources\Pages\AllPagesPagination as AllPagesPaginationResource;

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
     * @return \AllPagesPaginationResource
     */
    public function get_all_users_profile(IndexProfileRequest $request): AllPagesPaginationResource
    {
        try {
            $per_page = $request->query('per_page') ?? '15';

            $user_profiles = $this->_userRepository->get_user_profiles_by_pagination($per_page);
            return new AllPagesPaginationResource($user_profiles);
        } catch (InvalidArgumentException $e) {
            Log::error($e);
            return abort(response()->json(['message' => $e->getMessage()]), 404);
        }
    }
}
