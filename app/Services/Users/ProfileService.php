<?php

namespace App\Services\Users;

use Illuminate\Support\Facades\Storage;
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
     * @return ProfileResource
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

        // Modelにinsert用の配列を宣言
        $insert = [];

        // 送信されたファイルをストレージに保存
        if ($request->hasFile('icon_image') && $request->file('icon_image')->isValid()) {
            $filename = $request->file('icon_image')->store('/user/icon', 'public');
            $filepath = Storage::disk('public')->url($filename); // storageのurlを取得
        }

        if (isset($filepath)) {
            $insert = $request->except(['icon_image', 'icon_image_url']);
            $insert['icon_image_url'] = $filepath;
        }

        $insert = $insert ?? $request->except(['icon_image']);

        // ユーザープロフィールを変更か更新をする。
        $user_profile = $this->_userProfileRepository
                                ->updateOrCreate_user_profile($user->id, $insert);
        return new ProfileResource($user_profile);
    }
}
