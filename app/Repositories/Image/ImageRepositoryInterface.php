<?php

namespace App\Repositories\Image;

interface ImageRepositoryInterface
{
    public function create(array $inserts);

    public function updateOrCreate(array $inserts, string $id = null);
}
