<?php

namespace App\Services;

use App\Repositories\Storage\StorageRepositoryInterface;
use Carbon\Carbon;

class MyStorageService
{
    private $_storageRepository;

    private $_rand_len = 6;

    public function __construct(StorageRepositoryInterface $storageRepository)
    {
        $this->_storageRepository = $storageRepository;
    }

    /**
     * Storage IDを生成する
     * Storage ID: Timestamp + 子英数字(6文字)
     *
     * @return string
     */
    public function generateID(): string
    {
        $now_timestamp = Carbon::now()->timestamp;

        return strval($now_timestamp) . $this->makeRandStr($this->_rand_len);
    }

    /**
     * StorageIDであるか確認
     *
     * @param string $storage_id
     * @return boolean
     */
    public function is_storage_id(string $storage_id): bool
    {
        // 文字数が 16 文字じゃないとfalse
        if (strlen($storage_id) !== (10 + $this->_rand_len)) {
            return false;
        }

        $timestamp = substr($storage_id, 0, 10);
        $rand_str = substr($storage_id, 10);

        // substrでコケてないか確認
        if ($timestamp === false || $rand_str === false) {
            return false;
        }

        // timestampが数字かどうかとrandStrが小英数か確認
        if (preg_match('/^[0-9]+$/', $timestamp) === false && preg_match('/^[a-z0-9]+$/', $rand_str) === false) {
            return false;
        }

        $storage_id_time = new Carbon();
        $storage_id_time->timestamp = $timestamp;
        $now = Carbon::now();

        // 現在時刻よりも前だったらtrue
        return $storage_id_time->lt($now);
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
