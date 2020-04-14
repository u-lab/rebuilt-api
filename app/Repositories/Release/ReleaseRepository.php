<?php

namespace App\Repositories\Release;

use App\Models\Release;
use App\Repositories\Release\ReleaseRepositoryInterface;

class ReleaseRepository implements ReleaseRepositoryInterface
{
    protected $_release;

    public function __construct(Release $release)
    {
        $this->_release = $release;
    }

    public function get_release()
    {
        return $this->_release
                ->where('release_level', '>=', 20)
                ->get();
    }
}
