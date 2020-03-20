<?php

namespace App\Services;

use Exception;
use App\Facades\Helper;
use App\Http\Requests\BreadcrumbsRequest;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use App\Http\Resources\Breadcrumbs as BreadcrumbsResource;
use DaveJamesMiller\Breadcrumbs\Exceptions\InvalidBreadcrumbException;
use DaveJamesMiller\Breadcrumbs\Exceptions\UnnamedRouteException;

class BreadcrumbsService
{
    /**
     * 許可するURL
     *
     * @var string[]
     */
    protected $_allow_urls;

    /**
     * Create a new service instance.
     */
    public function __construct()
    {
        $this->_allow_urls = [
            'http://localhost:3000'
        ];
        $client = Helper::client_route('/');
        if (strcmp($this->_allow_urls[0], $client) !== 0) {
            $this->_allow_urls[] = $client;
        }
    }

    /**
     * パンくずリストを生成する
     *
     * @param \App\Http\Requests\BreadcrumbsRequest $request
     * @return BreadcrumbsResource
     * @throws \DaveJamesMiller\Breadcrumbs\Exceptions\UnnamedRouteException
     * @throws \DaveJamesMiller\Breadcrumbs\Exceptions\InvalidBreadcrumbException
     */
    public function render(BreadcrumbsRequest $request): BreadcrumbsResource
    {
        // pathを作成する。
        $path = $this->computed_request_path($request) ?? 'home';

        try {
            $data = $this->get_breadcrumb_data($path);
            if (is_null($data)) {
                throw new Exception;
            }

            if (isset($data['data'])) {
                return new BreadcrumbsResource(Breadcrumbs::generate($data['name'], $data['data']));
            }

            return new BreadcrumbsResource(Breadcrumbs::generate($data['name']));
        } catch (UnnamedRouteException $e) {
            // TODO:Exception that is thrown if the user attempt to render breadcrumbs for the current route but the current route doesn't have a name.を書く
            return abort(response()->json(['message' => $e->getMessage()], 500));
        } catch (InvalidBreadcrumbException $e) {
            // TODO: Exception that is thrown if the user attempts to generate breadcrumbs for a page that is not registered. を書く。
            return abort(response()->json(['message' => $e->getMessage()], 500));
        } catch (Exception $e) {
            return abort(response()->json(['message' => $e->getMessage()], 500));
        }
    }

    /**
     * Requestからpathを作成する
     *
     * @param BreadcrumbsRequest $request
     * @return string|null
     */
    protected function computed_request_path(BreadcrumbsRequest $request): ?string
    {
        $path = $request->path;
        if (isset($path)) {
            return $path;
        }

        $url = $request->url;
        if (isset($url)) {
            // ドメイン一覧の取得
            $allow_urls = $this->_allow_urls;
            // URLの部分を削除
            foreach ($allow_urls as $allow_url) {
                $replace_path = str_replace($allow_url, '', $url);
                // pathだけになった場合、break
                if (strcmp($url, $path) !== 0) {
                    $path = $replace_path;
                    break;
                }
            }
        }

        return $path;
    }

    /**
     * Breadcrumbs用のデータを作成する
     *
     * @param string $path
     * @return array|null
     */
    protected function get_breadcrumb_data(string $path): ?array
    {
        $path = trim($path, '/');
        $path_arr = explode("/", $path);
        if ($path_arr === false) {
            return null;
        }
        $path_arr_len = count($path_arr);

        $ret_arr = [
            'name' => null,
            'data' => null
        ];

        // pages関連
        if ($path_arr[0] === 'pages') {
            $user = $path_arr[1];

            if ($path_arr_len > 4) {
                $storage_id = $path_arr[3];
                $ret_arr['name'] = 'pages_storage_id';
                $ret_arr['data'] = [
                    'user'       => $user,
                    'storage_id' => $storage_id
                ];
                return $ret_arr;
            }

            $ret_arr['name'] = 'pages_user';
            $ret_arr['data'] = [
                'user' => $user,
            ];
            return $ret_arr;
        }

        $ret_arr['name'] = $path_arr[0];

        return $ret_arr;
    }
}
