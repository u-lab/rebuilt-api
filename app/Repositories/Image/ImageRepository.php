<?php

namespace App\Repositories\Image;

use App\Models\Image;
use App\Repositories\Image\ImageRepositoryInterface;

class ImageRepository implements ImageRepositoryInterface
{
    /**
     * @var \App\Models\Image
     */
    private $_image;

    public function __construct(Image $image)
    {
        $this->_image = $image;
    }

    public function create(array $inserts)
    {
        return $this->_image->create($inserts);
    }
}
