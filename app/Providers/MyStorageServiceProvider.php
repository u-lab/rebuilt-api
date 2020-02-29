<?php

namespace App\Providers;

use App\Services\MyStorageService;
use Illuminate\Support\ServiceProvider;

class MyStorageServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // MyStorageの追加
        $this->app->bind(
            'MyStorage',
            MyStorageService::class
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
