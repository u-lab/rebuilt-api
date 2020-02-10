<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\User\UserInfoRepository;
use App\Repositories\User\UserInfoRepositoryInterface;
use App\Repositories\User\UserPortfolioRepository;
use App\Repositories\User\UserPortfolioRepositoryInterface;
use App\Repositories\User\UserProfileRepository;
use App\Repositories\User\UserProfileRepositoryInterface;
use App\Repositories\Storage\StorageRepository;
use App\Repositories\Storage\StorageRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            UserInfoRepository::class,
            UserInfoRepositoryInterface::class
        );

        $this->app->bind(
            UserPortfolioRepositoryInterface::class,
            UserPortfolioRepository::class
        );

        $this->app->bind(
            UserProfileRepositoryInterface::class,
            UserProfileRepository::class
        );

        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );

        $this->app->bind(
            StorageRepositoryInterface::class,
            StorageRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
