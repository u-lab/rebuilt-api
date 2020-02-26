<?php

namespace App\Services\Users;

use App\Http\Requests\Users\UpdatePageRequest;
use App\Http\Resources\Users\Page as PageResource;
use App\Repositories\User\UserPortfolioRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PageService
{
    /**
     * @var \App\Repositories\User\UserPortfolioRepositoryInterface
     */
    private $_userPortfolioRepository;

    public function __construct(UserPortfolioRepositoryInterface $userPortfolioRepositoryInterface)
    {
        $this->_userPortfolioRepository = $userPortfolioRepositoryInterface;
    }

    /**
     * ユーザーの個人ページを取得する
     *
     * @param [type] $request
     * @return PageResource
     */
    public function get_user_page($request): PageResource
    {
        try {
            // ユーザーデータの取得
            $user = $request->user();
            // ユーザーのポートフォリオを取得
            $user_portfolio = $this->_userPortfolioRepository->get_user_portfolio_by_id($user->id);
            return new PageResource($user_portfolio);
        } catch (ModelNotFoundException $e) {
            return abort(response()->json(['message' => $e->getMessage()]), 404);
        }
    }

    public function update_user_page(UpdatePageRequest $request): PageResource
    {
        $user = $request->user();

        // ユーザーのポートフォリオを更新か作成
        $user_portfolio = $this->_userPortfolioRepository
                            ->updateOrCreate_user_portfolio($user->id, $request->all());

        return new PageResource($user_portfolio);
}
