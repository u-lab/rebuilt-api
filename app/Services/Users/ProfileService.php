<?php

namespace App\Services\Users;

use App\Repositories\User\UserProfileRepositoryInterface;
use App\Http\Resources\Users\Profile as ProfileResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProfileService
{
    private $_userProfileRepository;

    public function __construct(UserProfileRepositoryInterface $userProfileRepository)
    {
        $this->_userProfileRepository = $userProfileRepository;
    }

    /**
     * ユーザープロフィールを取得
     *
     * @return mixed
     */
    public function get_user_profile($request): ProfileResource
    {
        try {
            // ユーザーデータの取得
            $user = $request->user();
            // ユーザープロフィールの取得
            $user_profile = $this->_userProfileRepository->get_user_profile_by_id($user->id);

            return new ProfileResource($user_profile);
        } catch (ModelNotFoundException $e) {
            return abort(response()->json(['message' => $e->getMessage()]), 404);
        }
    }
}
