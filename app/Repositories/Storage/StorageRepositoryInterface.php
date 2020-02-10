<?php

namespace App\Repositories\Storage;

interface StorageRepositoryInterface
{
    public function get_storage(int $user_id, string $storage_id);
}
