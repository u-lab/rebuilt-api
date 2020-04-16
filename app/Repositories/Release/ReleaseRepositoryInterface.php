<?php

namespace App\Repositories\Release;

interface ReleaseRepositoryInterface
{
    /**
     * リリースの一覧を取得する
     *
     * @return mixed
     */
    public function get_release();
}
