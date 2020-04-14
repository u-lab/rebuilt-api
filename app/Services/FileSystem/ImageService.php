<?php

namespace App\Services\FileSystem;

use App\Events\ResizeImageDetectionEvent;
use App\Exceptions\FileSystem\FailedStoreFile;
use App\Repositories\Image\ImageRepositoryInterface;
use App\Services\FileSystem\FileSystemService;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Intervention\Image\Image as ImageImage;

class ImageService
{
    protected $_service;

    protected $_imageRepository;

    public function __construct(FileSystemService $service, ImageRepositoryInterface $imageRepository)
    {
        $this->_service = $service;
        $this->_imageRepository = $imageRepository;
    }

    public function store($file, string $name, string $path, string $image_id = null)
    {
        $filename = $this->_service->create_tmp($file); // 一時ファイルの作成
        $url = $this->store_image($file, $path, $filename);
        $ext = $this->_service->get_extension($file);
        $inserts = ['url' => $url];
        $inserts['title'] = $name;
        $inserts['extension'] = $ext;

        $imageModel = $this->_imageRepository->updateOrCreate($inserts, $image_id);

        event(new ResizeImageDetectionEvent($url, $path, $imageModel->id, $filename));
        return $imageModel->id;
    }

    /**
     * 画像をファイルに保存
     *
     * @param mixed $file
     * @param string $path
     * @return array
     */
    public function store_image($file, string $path, $filename): string
    {
        $path = $this->_service->format_path($path);
        $ext = $this->_service->get_extension($file);
        $image = Image::make($file);

        // オリジナル画像の保存
        $original_url = $this->store_original_image($image, $path, $filename, $ext);

        return $original_url;
    }

    /**
     * オリジナルの画像を保存する
     *
     * @param ImageImage $image
     * @param string $path
     * @param string $filename
     * @param string $ext
     * @return string
     * @throws FailedStoreFile
     */
    public function store_original_image(ImageImage $image, string $path, string $filename, string $ext): string
    {
        $bool = $this->_service->_disk->put($path.$filename, (string)$image->encode($ext, 90));
        if ($bool) {
            return $this->_service->_disk->url($path.$filename);
        }

        throw new FailedStoreFile();
    }

    public function store_resize_image_repository($url, $path, $image_id, $filename)
    {
        \Log::debug($url);
        \Log::debug($path);
        \Log::debug($filename);

        $file = $this->_service->_disk->get('.'.$path.'/'.$filename);
        $path = $this->_service->format_path($path);
        $ext = \File::extension($file);
        \Log::debug($ext);
        $image = Image::make($file);

        $urls = $this->store_resize_image($image, $ext, $path, $filename);

        $inserts = $urls;

        $this->_imageRepository->updateOrCreate($inserts, $image_id);
    }

    public function store_resize_image(ImageImage $image, string $ext, string $path, string $filename)
    {
        $sizes = [80, 160, 320, 640, 1024, 1280, 1920, 2580];
        // 画像をまとめてリサイズする
        $imageArr = $this->resizing_in_bulk($image, $ext, $sizes);

        $urls = [];
        // リサイズした画像を保存する
        foreach ($imageArr as $_image) {
            $_filename = $path.$_image->width().'-'.$filename;
            $this->_service->_disk->put($_filename, (string)$_image);
            $urls['url_'.$_image->width()] = $this->_service->_disk->url($_filename);
        }

        // 一時ファイルを削除
        $this->_service->_localDisk->delete('tmp/'.$filename);
        return $urls;
    }


    /**
     * 画像をまとめてリサイズする
     *
     * @param ImageImage $image
     * @param string $extension
     * @param integer[] $sizes
     * @param integer $quality
     * @return ImageImage[]
     */
    public function resizing_in_bulk(ImageImage $image, string $extension, array $sizes, int $quality = 70): array
    {
        $retArr = [];
        rsort($sizes); // 数値の大きい順にソート
        // それぞれのサイズの画像を作成
        foreach ($sizes as $size) {
            if ($image->width() > $size) {
                $retArr[] = $this->image_resize($image, $extension, $size, $quality);
            }
        }

        return $retArr;
    }

    /**
     * 画像のリサイズをする
     *
     * @param ImageImage $image
     * @param string $extension
     * @param integer $width
     * @param integer $quality
     * @return ImageImage
     */
    public function image_resize(ImageImage $image, string $extension, int $width, int $quality = 70): ImageImage
    {
        $image->orientate(); // 回転の補正
        return $image->resize($width, null, function ($constraint) {
            $constraint->upsize();
            $constraint->aspectRatio();
        })->encode($extension, $quality);
    }
}
