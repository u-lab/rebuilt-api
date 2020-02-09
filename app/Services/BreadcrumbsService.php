<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;
use App\Http\Requests\BreadcrumbsFormRequest;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

class BreadcrumbsService
{
    /**
     * パンくずリストを生成する
     *
     * @param BreadcrumbsFormRequest $request
     * @return JsonResponse
     */
    public function render(BreadcrumbsFormRequest $request): JsonResponse
    {
        $breadcrumbs_html_string = Breadcrumbs::view('breadcrumbs::json-ld', 'blog');
        // <script type="application/ld+json"></script>を削除
        return response()->json(strip_tags($breadcrumbs_html_string));
    }
}
