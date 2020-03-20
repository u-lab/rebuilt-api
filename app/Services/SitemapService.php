<?php

namespace App\Services;

use App\Facades\Helper;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\Sitemap as SitemapResource;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Storage\StorageRepositoryInterface;

class SitemapService
{
    /**
     * @var \App\Repositories\User\UserRepositoryInterface
     */
    protected $_userRepository;

    /**
     * @var \App\Repositories\Storage\StorageRepositoryInterface
     */
    protected $_storageRepository;

    public function __construct(UserRepositoryInterface $userRepository, StorageRepositoryInterface $storageRepository)
    {
        $this->_userRepository = $userRepository;
        $this->_storageRepository = $storageRepository;
    }

    /**
     * サイトマップの作成
     *
     * @return SitemapResource
     */
    public function generate(): SitemapResource
    {
        $urls = [$this->client_url('/')];
        $urls = array_merge($urls, $this->generate_pages());
        $urls = array_merge($urls, $this->generate_page_storages());
        return new SitemapResource($urls);
    }

    /**
     * フロントのURLを作成
     *
     * @param string $path
     * @return string
     */
    protected function client_url(string $path = '/'): string
    {
        return Helper::client_route($path);
    }

    /**
     * /pages/{user}に関するurl一覧を作成
     *
     * @return array|null
     */
    protected function generate_pages(): ?array
    {
        $users = $this->_userRepository->get_all_user_with_profile();
        $urls = [];
        foreach ($users as $user) {
            $urls[] = $this->client_url('pages/' . $user->name);
        }
        return $urls;
    }

    /**
     * /pages/{user}/storages/{storage_id}に関するurl一覧を作成
     *
     * @return array|null
     */
    protected function generate_page_storages(): ?array
    {
        $storages = $this->_storageRepository->get_all_storages_with_user();
        $urls = [];
        foreach ($storages as $storage) {
            $urls[] = $this->client_url('pages/' . $storage->user->name . '/storages' . '/' . $storage->storage_id);
        }
        return $urls;
    }
}
