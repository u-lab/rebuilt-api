<?php

namespace App\Services\Pages;

use Log;
use Exception;
use App\Http\Requests\Pages\ShowPageRequest;
use App\Http\Resources\Page as PageResource;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PageService
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
     * 個人ページのデータを返す
     *
     * @param \App\Http\Requests\Pages\ShowPageRequest $request
     * @param string $user
     * @return PageResource
     */
    public function get_user_page(ShowPageRequest $request, string $user): PageResource
    {
        try {
            $user = $this->_userRepository->get_user_by_name($user);
            return new PageResource($user);
        } catch (ModelNotFoundException $e) {
            Log::error($e);
            $message = $user . 'is not exsisted.';
            return abort(response()->json(['message' => $message], 404));
        }
    }
}
