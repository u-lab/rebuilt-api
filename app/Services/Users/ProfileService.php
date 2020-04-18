<?php

namespace App\Services\Users;

use App\Http\Requests\Users\ShowProfileRequest;
use App\Http\Requests\Users\UpdateProfileRequest;
use App\Repositories\User\UserProfileRepositoryInterface;
use App\Http\Resources\Users\Profile as ProfileResource;
use App\Repositories\User\UserCareerRepositoryInterface;
use App\Services\FileSystem\ImageService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Carbon;

class ProfileService
{
    private $_userProfileRepository;

    private $_userCareerRepository;

    private $_imageService;

    public function __construct(
        UserProfileRepositoryInterface $userProfileRepository,
        UserCareerRepositoryInterface $userCareerRepository,
        ImageService $imageService
    ) {
        $this->_userProfileRepository = $userProfileRepository;
        $this->_userCareerRepository = $userCareerRepository;
        $this->_imageService = $imageService;
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
        if ($request->hasFile('icon_image') && $request->file('icon_image')) {
            $icon_image_id = $this->_imageService
                ->store($request->file('icon_image'), 'icon_image', '/user/icon');
            if (isset($icon_image_id)) {
                $insert = $request->except(['icon_image', 'icon_image_id']);
                $insert['icon_image_id'] = $icon_image_id;
            }
        }


        // 送信されたファイルをストレージに保存
        if ($request->hasFile('background_image') && $request->file('background_image')) {
            $background_image_id = $this->_imageService
                ->store($request->file('background_image'), 'background_image', '/user/background');
            if (isset($background_image_id)) {
                $insert = $request->except(['background_image', 'background_image_id']);
                $insert['background_image_id'] = $background_image_id;
            }
        }

        $insert = $insert ?? $request->except(['icon_image', 'background_image']);

        // user_careerの挿入
        // TODO: バルクインサートにしたい
        if (count($request->user_career) % 4 === 0) {
            for ($idx = 0; $idx < count($request->user_career); $idx += 4) {
                $insert_user_career = \Arr::collapse([
                    $request->user_career[$idx],
                    $request->user_career[$idx + 1],
                    $request->user_career[$idx + 2],
                    $request->user_career[$idx + 3]
                ]);
                $insert_data = [
                    'date' => new Carbon($insert_user_career['date']),
                    'name' => $insert_user_career['name'],
                    'type' => $insert_user_career['type'],
                ];
                if (isset($insert_user_career['id'])) {
                    $insert_data['id'] = $insert_user_career['id'];
                    $this->_userCareerRepository
                    ->updateOrCreate($insert_data, $user->id, $insert_user_career['id']);
                } else {
                    $this->_userCareerRepository
                        ->updateOrCreate($insert_data, $user->id);
                }
            }
        }

        if (isset($request->user_career_did)) {
            foreach ($request->user_career_did as $id) {
                $this->_userCareerRepository->delete($user->id, $id);
            }
        }

        // ユーザープロフィールを変更か更新をする。
        $user_profile = $this->_userProfileRepository
                            ->updateOrCreate_user_profile($user->id, $insert);
        return new ProfileResource($user_profile);
    }
}
