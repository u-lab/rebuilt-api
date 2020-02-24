<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;
use App\Http\Requests\BreadcrumbsFormRequest;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use App\Http\Resources\Breadcrumbs as BreadcrumbsResource;
use DaveJamesMiller\Breadcrumbs\Exceptions\InvalidBreadcrumbException;
use DaveJamesMiller\Breadcrumbs\Exceptions\UnnamedRouteException;

class BreadcrumbsService
{
    /**
     * パンくずリストを生成する
     *
     * @param BreadcrumbsFormRequest $request
     * @return BreadcrumbsResource
     * @throws \DaveJamesMiller\Breadcrumbs\Exceptions\UnnamedRouteException
     * @throws \DaveJamesMiller\Breadcrumbs\Exceptions\InvalidBreadcrumbException
     */
    public function render(BreadcrumbsFormRequest $request): BreadcrumbsResource
    {
        // TODO: $request を使って、パンくずリストを生成。
        $breadcrumbs_name = 'blog';

        try {
            return new BreadcrumbsResource(Breadcrumbs::generate($breadcrumbs_name));
        } catch (UnnamedRouteException $e) {
            // TODO:Exception that is thrown if the user attempt to render breadcrumbs for the current route but the current route doesn't have a name.を書く
            return abort(response()->json(['message' => $e->getMessage()], 500));
        } catch (InvalidBreadcrumbException $e) {
            // TODO: Exception that is thrown if the user attempts to generate breadcrumbs for a page that is not registered. を書く。
            return abort(response()->json(['message' => $e->getMessage()], 500));
        }
    }
}
