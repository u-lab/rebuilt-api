<?php

namespace App\Repositories\Release;

use App\Models\Release;
use App\Repositories\Release\ReleaseRepositoryInterface;
use Cache;

class ReleaseRepository implements ReleaseRepositoryInterface
{
    protected $_release;

    public function __construct(Release $release)
    {
        $this->_release = $release;
    }

    /**
     * リリースの一覧を取得する
     *
     * @return mixed
     */
    public function get_release()
    {
        return Cache::remember('get_release_ReleaseRepository', 600, function () {
            return $this->_release
                ->where('release_level', '>=', 20)
                ->get();
        });
    }
}
