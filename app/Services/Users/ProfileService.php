<?php

namespace App\Services\Users;

use App\Http\Requests\Users\UpdateProfileRequest;
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

    /**
     * Profileを更新する
     *
     * @param UpdateProfileRequest $request
     * @return ProfileResource
     */
    public function update_profile(UpdateProfileRequest $request): ProfileResource
    {
        $user = $request->user();

        // ユーザープロフィールを変更か更新をする。
        $user_profile = $this->_userProfileRepository
                            ->updateOrCreate_user_profile($user->id, $request->all());
        return new ProfileResource($user_profile);
    }
}
