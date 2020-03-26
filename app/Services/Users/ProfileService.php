<?php

namespace App\Services\Users;

use App\Services\FileSystemService;
use App\Http\Requests\Users\ShowProfileRequest;
use App\Http\Requests\Users\UpdateProfileRequest;
use App\Repositories\User\UserProfileRepositoryInterface;
use App\Http\Resources\Users\Profile as ProfileResource;
use App\Repositories\User\UserCareerRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProfileService
{
    private $_userProfileRepository;

    private $_userCareerRepository;

    private $_fileSystemService;

    public function __construct(
        UserProfileRepositoryInterface $userProfileRepository,
        UserCareerRepositoryInterface $userCareerRepository,
        FileSystemService $fileSystemService
    ) {
        $this->_userProfileRepository = $userProfileRepository;
        $this->_userCareerRepository = $userCareerRepository;
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

        // 送信されたファイルをストレージに保存
        $background_image_id = $this->_fileSystemService
                                ->store_requestImage($request, 'background_image', '/user/background');

        if (isset($background_image_id)) {
            $insert = $request->except(['background_image', 'background_image_id']);
            $insert['background_image_id'] = $background_image_id;
        }

        $insert = $insert ?? $request->except(['icon_image', 'background_image']);

        // user_careerの挿入
        // TODO: バルクインサートにしたい
        foreach ($request->user_career as $insert_user_career) {
            if (isset($insert_user_career->id)) {
                $this->_userCareerRepository
                        ->updateOrCreate($insert_user_career, $request->user_id, $insert_user_career->id);
            } else {
                $this->_userCareerRepository
                        ->updateOrCreate($insert_user_career, $request->user_id);
            }
        }

        // ユーザープロフィールを変更か更新をする。
        $user_profile = $this->_userProfileRepository
                                ->updateOrCreate_user_profile($user->id, $insert);
        return new ProfileResource($user_profile);
    }
}
