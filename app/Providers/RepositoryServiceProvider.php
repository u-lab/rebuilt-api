<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Image\ImageRepository;
use App\Repositories\Image\ImageRepositoryInterface;
use App\Repositories\Release\ReleaseRepository;
use App\Repositories\Release\ReleaseRepositoryInterface;
use App\Repositories\Storage\StorageFileRepository;
use App\Repositories\Storage\StorageFileRepositoryInterface;
use App\Repositories\Storage\StorageSubImageRepository;
use App\Repositories\Storage\StorageSubImageRepositoryInterface;
use App\Repositories\Storage\StorageRepository;
use App\Repositories\Storage\StorageRepositoryInterface;
use App\Repositories\User\UserCareerRepository;
use App\Repositories\User\UserCareerRepositoryInterface;
use App\Repositories\User\UserInfoRepository;
use App\Repositories\User\UserInfoRepositoryInterface;
use App\Repositories\User\UserPortfolioRepository;
use App\Repositories\User\UserPortfolioRepositoryInterface;
use App\Repositories\User\UserProfileRepository;
use App\Repositories\User\UserProfileRepositoryInterface;
use App\Repositories\User\UserReleaseRepository;
use App\Repositories\User\UserReleaseRepositoryInterface;

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
            UserCareerRepositoryInterface::class,
            UserCareerRepository::class
        );

        $this->app->bind(
            UserInfoRepositoryInterface::class,
            UserInfoRepository::class
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
            UserReleaseRepositoryInterface::class,
            UserReleaseRepository::class
        );

        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );

        $this->app->bind(
            StorageRepositoryInterface::class,
            StorageRepository::class
        );

        $this->app->bind(
            StorageSubImageRepositoryInterface::class,
            StorageSubImageRepository::class
        );

        $this->app->bind(
            StorageFileRepositoryInterface::class,
            StorageFileRepository::class
        );

        $this->app->bind(
            ImageRepositoryInterface::class,
            ImageRepository::class
        );

        $this->app->bind(
            ReleaseRepositoryInterface::class,
            ReleaseRepository::class
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
