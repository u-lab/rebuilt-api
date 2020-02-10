<?php

namespace App\Services\Pages;

use App\Http\Requests\Pages\ShowPageRequest;
use App\Repositories\User\UserRepositoryInterface;

class PageService
{
    /**
     * @var \App\Repositories\User\UserRepositoryInterface
     */
    private $_userRepositoryInterface;

    public function __construct(UserRepositoryInterface $userRepositoryInterface)
    {
        $this->_userRepositoryInterface = $userRepositoryInterface;
    }

    public function get_user_page(ShowPageRequest $request, string $user)
    {
        return $this->_userRepositoryInterface->get_user_page($user);
    }
}
