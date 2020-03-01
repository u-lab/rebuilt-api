<?php

namespace App\Services;

use Exception;
use Intervention\Image\Facades\Image;
use Intervention\Image\Image as ImageImage;
use Illuminate\Support\Facades\Storage;

class FileSystemService
{
    public function __construct()
    {
    }

    public function store_requestFile($request, string $request_name, string $path = ''): ?array
    {
        // アイキャッチ画像の保存
        if ($request->hasFile($request_name) === false
                && $request->file($request_name)->isValid() === false) {
            return null;
        }

        $file = $request->file($request_name);
        $path = '/'.trim($path, '/').'/';

        // 一時ファイルの作成
        $filename_tmp = $file->store('/tmp', 'local');
        $filename = trim($filename_tmp, 'tmp/');

        // 画像の拡張子を取得
        $extension = $file->getClientOriginalExtension();

        $img = Image::make($file);

        // ファイルに追加
        $this->store_image($img, $path, $filename, $extension);
        // Storage::disk('public')
        //         ->put($path.$filename, (string)$img, 'public');

        // 画像のURLを参照
        $url = Storage::disk('public')->url($path.$filename);

        // 一時ファイルを削除
        $tmp_delete = Storage::disk('local')->delete($filename_tmp);
        if ($tmp_delete === false) {
            throw new Exception();
        }

        return [
            'original' => $url,
            '1200' => Storage::disk('public')->url($path.'1200-'.$filename),
            '900' => Storage::disk('public')->url($path.'900-'.$filename),
            '600' => Storage::disk('public')->url($path.'600-'.$filename),
            '300' => Storage::disk('public')->url($path.'300-'.$filename)
        ];
    }

    private function store_image(ImageImage $image, string $path, string $filename, $extension)
    {
        $storage = Storage::disk('public');
        // originalの保存
        \Log::debug('original');
        $storage->put($path.$filename, (string)$image, 'public');
        \Log::debug('aaa');
        $storage->put(
            $path.'1200-'.$filename,
            (string)$this->image_resize($image, 1200, $extension),
            'public'
        );
        \Log::debug('bbb');

        $storage->put(
            $path.'900-'.$filename,
            (string)$this->image_resize($image, 900, $extension),
            'public'
        );
        $storage->put(
            $path.'600-'.$filename,
            (string)$this->image_resize($image, 600, $extension),
            'public'
        );
        $storage->put(
            $path.'300-'.$filename,
            (string)$this->image_resize($image, 300, $extension),
            'public'
        );
    }

    private function image_resize(ImageImage $image, int $width, $extension): ImageImage
    {
        return $image->resize($width, null, function ($constraint) {
            $constraint->upsize();
            $constraint->aspectRatio();
        });
    }
}
