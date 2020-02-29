<?php

namespace App\Services;

use Carbon\Carbon;

class MyStorageService
{
    public function __construct()
    {
    }

    /**
     * Storage IDを生成する
     *
     * @return string
     */
    public function generateID(): string
    {
        $now_timestamp = Carbon::now()->timestamp;

        return strval($now_timestamp) . $this->makeRandStr(6);
    }

    /**
     * ランダム文字列生成 (英小文字 + 数字)
     * @param integer $length: 生成する文字数
     * @return string
     */
    protected function makeRandStr(int $length): string
    {
        $str = array_merge(range('a', 'z'), range('0', '9'));
        $r_str = '';
        for ($i = 0; $i < $length; $i++) {
            $r_str .= $str[rand(0, count($str) - 1)];
        }
        return $r_str;
    }
}
