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
        $sizes = $this->store_image($img, $path, $filename, $extension);

        // 画像のURLを参照
        $url = Storage::disk('public')->url($path.$filename);

        // 一時ファイルを削除
        $tmp_delete = Storage::disk('local')->delete($filename_tmp);
        if ($tmp_delete === false) {
            throw new Exception();
        }

        $retVal = ['original' => $url];

        foreach ($sizes as $size) {
            $retVal[$size] = Storage::disk('public')->url($path.$size.'-'.$filename);
        }

        return $retVal;
    }

    private function store_image(ImageImage $image, string $path, string $filename, $extension)
    {
        $storage = Storage::disk('public');
        // 回転を補正
        $image->orientate();

        // originalの保存
        $storage->put($path.$filename, (string)$image->encode($extension), 'public');
        $create_sizes = [];

        // 作りたい画像のサイズ
        $sizes = [1200, 900, 600, 300];

        // それぞれのサイズの画像を作成
        foreach ($sizes as $size) {
            if ($image->width() > $size) {
                $storage->put(
                    $path.$size.'-'.$filename,
                    (string)$this->image_resize($image, $size, $extension),
                    'public'
                );
                $create_sizes[] = $size;
            }
        }

        return $create_sizes;
    }

    private function image_resize(ImageImage $image, int $width, $extension): ImageImage
    {
        return $image->resize($width, null, function ($constraint) {
            $constraint->upsize();
            $constraint->aspectRatio();
        })->encode($extension);
    }
}
