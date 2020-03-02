<?php

namespace App\Services;

use Exception;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Image as ImageImage;
use App\Exceptions\Image\FailedUploadImage;
use App\Repositories\Image\ImageRepositoryInterface;
use Str;

class FileSystemService
{
    /**
     * @var \App\Repositories\Image\ImageRepositoryInterface
     */
    private $_imageRepository;

    /**
     * @var \Illuminate\Filesystem\FilesystemAdapter
     */
    private $_localDisk;

    /**
     * @var \Illuminate\Filesystem\FilesystemAdapter
     */
    private $_publicDisk;

    /**
     * @var int[]
     */
    private $_sizes;

    /**
     * @var array
     */
    private $_inserts;

    public function __construct(ImageRepositoryInterface $imageRepository)
    {
        $this->_imageRepository = $imageRepository;
        $this->_localDisk = Storage::disk('local');
        $this->_publicDisk = Storage::disk('public');
        $this->_sizes = [160, 320, 640, 1024, 1280, 1920, 2580];
        $this->_inserts = [
            'id'       => Str::uuid(),
            'title'    => null,
            'url'      => null,
            'url_160'  => null,
            'url_320'  => null,
            'url_640'  => null,
            'url_1024' => null,
            'url_1280' => null,
            'url_1920' => null,
            'url_2580' => null
        ];
    }

    public function store_requestImage($request, string $image_name, string $path = ''): string
    {
        // postされたimageがアップロードできているか確認
        if ($request->hasFile($image_name) === false
                && $request->file($image_name) === false) {
            throw new FailedUploadImage('正常にファイルをアップロードできていません。');
        }

        $file = $request->file($image_name);
        $path = '/'.trim($path, '/').'/';

        // ファイルを一時ファイルに保存
        $filename_tmp = $file->store('/tmp', 'local');
        $filename = trim($filename_tmp, 'tmp/');

        // 画像の拡張子を取得
        $extension = $file->getClientOriginalExtension();

        $img = Image::make($file);

        // ファイルに追加
        $sizes = $this->store_image($img, $path, $filename, $extension);

        // 画像のURLを参照
        $url = $this->_publicDisk->url($path.$filename);

        // 一時ファイルを削除
        $tmp_delete = $this->_localDisk->delete($filename_tmp);
        if ($tmp_delete === false) {
            throw new Exception();
        }

        // すべてのサイズの画像URLを生成
        $inserts = $this->_inserts;

        $inserts['title'] = $image_name;
        $inserts['url'] = $url;

        foreach ($sizes as $size) {
            $inserts['url_'.$size] = $this->_publicDisk->url($path.$size.'-'.$filename);
        }

        // Modelに挿入
        $imageModel = $this->_imageRepository->create($inserts);

        return $imageModel->id;
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
        $localDisk = Storage::disk('local');
        $publicDisk = Storage::disk('public');

        // 一時ファイルの作成
        $filename_tmp = $file->store('/tmp', 'local');
        $filename = trim($filename_tmp, 'tmp/');

        // 画像の拡張子を取得
        $extension = $file->getClientOriginalExtension();

        $img = Image::make($file);

        // ファイルに追加
        $sizes = $this->store_image($img, $path, $filename, $extension);

        // 画像のURLを参照
        $url = $publicDisk->url($path.$filename);

        // 一時ファイルを削除
        $tmp_delete = $localDisk->delete($filename_tmp);
        if ($tmp_delete === false) {
            throw new Exception();
        }

        $retVal = ['original' => $url];

        foreach ($sizes as $size) {
            $retVal[$size] = $publicDisk->url($path.$size.'-'.$filename);
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
        $sizes = $this->_sizes;

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
