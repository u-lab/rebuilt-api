<?php

namespace App\Services\Users;

use App\Http\Resources\Util\Release as ReleaseResource;
use App\Repositories\Release\ReleaseRepositoryInterface;

class ReleaseService
{
    protected $_releaseRepository;

    public function __construct(ReleaseRepositoryInterface $releaseRepositoryInterface)
    {
        $this->_releaseRepository = $releaseRepositoryInterface;
    }

    public function get_release()
    {
        return ReleaseResource::collection($this->_releaseRepository->get_release());
    }
}
