<?php

namespace App\Services\Users;

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
        return $this->_releaseRepository->get_release();
    }
}
