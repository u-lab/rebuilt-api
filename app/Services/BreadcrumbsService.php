<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;
use App\Http\Requests\BreadcrumbsFormRequest;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use App\Http\Resources\Breadcrumbs as BreadcrumbsResource;

class BreadcrumbsService
{
    /**
     * パンくずリストを生成する
     *
     * @param BreadcrumbsFormRequest $request
     * @return mixed
     */
    public function render(BreadcrumbsFormRequest $request)
    {
        return new BreadcrumbsResource(Breadcrumbs::generate('blog'));
    }
}
