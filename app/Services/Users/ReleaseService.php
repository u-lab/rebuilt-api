<?php

namespace App\Services\Users;

use App\Http\Resources\Util\Release as ReleaseResource;
use App\Repositories\Release\ReleaseRepositoryInterface;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ReleaseService
{
    protected $_releaseRepository;

    public function __construct(ReleaseRepositoryInterface $releaseRepositoryInterface)
    {
        $this->_releaseRepository = $releaseRepositoryInterface;
    }

    /**
     * リリースの一覧を取得する
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function get_release(): AnonymousResourceCollection
    {
        return ReleaseResource::collection($this->_releaseRepository->get_release());
    }
}
