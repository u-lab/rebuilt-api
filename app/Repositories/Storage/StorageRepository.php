<?php

namespace App\Repositories\Storage;

use App\Models\Storage;
use App\Repositories\Storage\StorageRepositoryInterface;

class StorageRepository implements StorageRepositoryInterface
{
    public function get_storage(int $user_id, string $storage_id)
    {
        $storage = Storage::where('user_id', '=', $user_id)
            ->where('storage_id', '=', $storage_id)
            ->first();

        return $storage;
    }
}
