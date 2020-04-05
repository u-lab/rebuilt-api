<?php

namespace App\Services;

use Log;
use Str;
use Exception;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Image as ImageImage;
use App\Exceptions\Image\FailedUploadImage;
use App\Repositories\Image\ImageRepositoryInterface;
use App\Repositories\Storage\StorageFileRepositoryInterface;

class FileSystemService
{
    /**
     * @var \App\Repositories\Image\ImageRepositoryInterface
     */
    private $_imageRepository;

    /**
     * @var \App\Repositories\Storage\StorageFileRepositoryInterface
     */
    private $_storageFileRepository;

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

    public function __construct(
        ImageRepositoryInterface $imageRepository,
        StorageFileRepositoryInterface $storageFileRepository
    ) {
        $this->_imageRepository = $imageRepository;
        $this->_storageFileRepository = $storageFileRepository;
        $this->_localDisk = Storage::disk('local');
        $this->_publicDisk = Storage::disk('public');
        $this->_sizes = [80, 160, 320, 640, 1024, 1280, 1920, 2580];
        $this->_inserts = [
            'id'       => Str::uuid(),
            'title'    => null,
            'url'      => null,
            'url_80'   => null,
            'url_160'  => null,
            'url_320'  => null,
            'url_640'  => null,
            'url_1024' => null,
            'url_1280' => null,
            'url_1920' => null,
            'url_2580' => null
        ];
    }

    /**
     * StorageとDBに画像を保存
     *
     * @param Request $request
     * @param string $image_name
     * @param string $path
     * @return string
     * @throws Exception
     * @throws \RuntimeException
     * @throws \App\Exceptions\Image\FailedUploadImage
     */
    public function store_requestImage($request, string $image_name, string $path = ''): ?string
    {
        // postされたimageがアップロードできているか確認
        if ($request->hasFile($image_name) === false) {
            return null;
        }

        if ($request->file($image_name) === false) {
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
        $inserts = $this->store_image($img, $path, $filename, $extension);
        $inserts['title'] = $image_name;

        if (isset($inserts['url'])) {
            // 一時ファイルを削除
            $tmp_delete = $this->_localDisk->delete($filename_tmp);
            if ($tmp_delete === false) {
                throw new Exception();
            }

            // Modelに挿入
            $imageModel = $this->_imageRepository->create($inserts);

            // uuidを返す
            return $imageModel->id;
        }

        $this->store_image_error($filename);
    }

    public function store_requestStorage($request, int $storage_id, string $storage_name, string $path = ''): ?string
    {
        // postされたfileがアップロードできているか確認
        if ($request->hasFile($storage_name) === false) {
            return null;
        }

        if ($request->file($storage_name) === false) {
            throw new FailedUploadImage('正常にファイルをアップロードできていません。');
        }

        $file = $request->file($storage_name);
        $path = '/'.trim($path, '/');

        // 送信元の拡張子を取得
        $original_ext = strtolower($file->getClientOriginalExtension());

        // Storageにファイルを保存
        $storage_filename = $this->_publicDisk->putFileAs(
            $path,
            $file,
            Str::uuid() . '.' . $original_ext
        );

        $storage_url = $this->_publicDisk->url($storage_filename);

        $storage_file = $this->_storageFileRepository->updateOrCreate([
            'storage_id' => $storage_id,
            'url'        => $storage_url,
            'extension'  => $original_ext
        ], $storage_id);

        return '';
    }

    /**
     * imageが保存できていないときのエラー
     *
     * @param string $filename
     * @return void
     * @throws Exception
     */
    private function store_image_error(string $filename)
    {
        $errMessage = "正常にファイルを保存できていません。ファイル名：" . $filename;
        Log::error($errMessage);
        throw new Exception;
    }

    /**
     * 画像をStorageに保存する
     *
     * @param ImageImage $image
     * @param string $path
     * @param string $filename
     * @param string $extension 拡張子
     * @return array URLを返す
     */
    private function store_image(ImageImage $image, string $path, string $filename, $extension): array
    {
        // 回転を補正
        $image->orientate();

        // originalの保存
        $this->_publicDisk->put($path.$filename, (string)$image->encode($extension), 'public');
        $store_sizes = [];
        $inserts = $this->_inserts;

        // 作りたい画像のサイズ
        $sizes = $this->_sizes;

        // それぞれのサイズの画像を作成
        foreach ($sizes as $size) {
            if ($image->width() > $size) {
                $this->_publicDisk->put(
                    $path.$size.'-'.$filename,
                    (string)$this->image_resize($image, $size, $extension),
                    'public'
                );
                $store_sizes[] = $size;
            }
        }

        // 画像のURLを参照
        $url = $this->_publicDisk->url($path.$filename);

        $inserts['url'] = $url;

        foreach ($store_sizes as $size) {
            $inserts['url_'.$size] = $this->_publicDisk->url($path.$size.'-'.$filename);
        }

        return $inserts;
    }

    /**
     * 画像のリサイズをする
     *
     * @param ImageImage $image
     * @param integer $width
     * @param string $extension
     * @return ImageImage
     */
    private function image_resize(ImageImage $image, int $width, $extension): ImageImage
    {
        return $image->resize($width, null, function ($constraint) {
            $constraint->upsize();
            $constraint->aspectRatio();
        })->encode($extension);
    }
}
