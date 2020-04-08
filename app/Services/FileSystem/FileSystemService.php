<?php

namespace App\Services\FileSystem;

use Storage;

class FileSystemService
{
    /**
     * @var \Illuminate\Contracts\Filesystem\Filesystem
     */
    public $_disk;

    public $_localDisk;

    public function __construct()
    {
        $default = config('filesystems.default');
        $this->_disk = Storage::disk($default);
        $this->_localDisk = Storage::disk('local');
    }

    /**
     * 一時ファイルの作成
     *
     * @param mixed $file
     * @return string
     */
    public function create_tmp($file): string
    {
        // ファイルを一時ファイルに保存
        $filename_tmp = $file->store('/tmp', 'local');
        $filename = trim($filename_tmp, 'tmp/');
        return $filename;
    }


    /**
     * pathをきれいにする
     *
     * @param string $path
     * @return string
     */
    public function format_path(string $path): string
    {
        return '/'.trim($path, '/').'/';
    }

    /**
     * 拡張子を取得する
     *
     * @param mixed $file
     * @return string
     */
    public function get_extension($file): string
    {
        return strtolower($file->getClientOriginalExtension());
    }
}
