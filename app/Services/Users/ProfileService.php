<?php

namespace App\Services\Users;

use App\Services\FileSystemService;
use App\Http\Requests\Users\ShowProfileRequest;
use App\Http\Requests\Users\UpdateProfileRequest;
use App\Repositories\User\UserProfileRepositoryInterface;
use App\Http\Resources\Users\Profile as ProfileResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProfileService
{
    private $_userProfileRepository;

    private $_fileSystemService;

    public function __construct(
        UserProfileRepositoryInterface $userProfileRepository,
        FileSystemService $fileSystemService
    ) {
        $this->_userProfileRepository = $userProfileRepository;
        $this->_fileSystemService = $fileSystemService;
    }

    /**
     * ユーザープロフィールを取得
     *
     * @param \App\Http\Requests\Users\ShowProfileRequest $request
     * @return ProfileResource
     */
    public function get_user_profile(ShowProfileRequest $request): ProfileResource
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

        // Modelにinsert用の配列を宣言
        $insert = [];

        // 送信されたファイルをストレージに保存
        $icon_image_id = $this->_fileSystemService
                                ->store_requestImage($request, 'icon_image', '/user/icon');

        if (isset($icon_image_id)) {
            $insert = $request->except(['icon_image', 'icon_image_id']);
            $insert['icon_image_id'] = $icon_image_id;
        }

        $insert = $insert ?? $request->except(['icon_image']);

        // ユーザープロフィールを変更か更新をする。
        $user_profile = $this->_userProfileRepository
                                ->updateOrCreate_user_profile($user->id, $insert);
        return new ProfileResource($user_profile);
    }
}
