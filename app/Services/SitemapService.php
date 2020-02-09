<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;

class SitemapService
{
    public function generate(): JsonResponse
    {
        return response()->json([]);
    }
}
