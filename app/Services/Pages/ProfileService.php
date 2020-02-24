<?php

namespace App\Services\Pages;

use Log;
use InvalidArgumentException;
use App\Http\Requests\Pages\IndexProfileRequest;
use App\Repositories\User\UserProfileRepositoryInterface;

class ProfileService
{
    /**
     * @var \App\Repositories\User\UserProfileRepositoryInterface
     */
    private $_userProfileRepository;

    public function __construct(UserProfileRepositoryInterface $userProfileRepository)
    {
        $this->_userProfileRepository = $userProfileRepository;
    }

    /**
     * すべてのユーザーのプロフィールを取得する
     *
     * @param IndexProfileRequest $request
     * @return mixed
     */
    public function get_all_users_profile(IndexProfileRequest $request)
    {
        try {
            $user_profiles = $this->_userProfileRepository->get_user_profiles_by_pagination();
            return $user_profiles;
        } catch (InvalidArgumentException $e) {
            Log::error($e);
            return abort(response()->json(['message' => $e->getMessage()]), 404);
        }
    }
}
