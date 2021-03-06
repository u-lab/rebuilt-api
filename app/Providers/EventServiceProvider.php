<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        // アクセスを検出するイベント
        'App\Events\AccessApiDetectionEvent' => [
            // アクセスIP, Route記録リスナー
            'App\Listeners\AccessIpAndRouteRecordListener',
        ],

        // ModelNotFound用イベント
        'App\Events\ModelNotFoundDetectionEvent' => [
            'App\Listeners\ModelNotFoundRecordListener',
        ],

        // 画像のリサイズをするイベント
        'App\Events\ResizeImageDetectionEvent' => [
            'App\Listeners\ResizeImageRecordListener',
        ],

        // メンテナンスモードに入ったことを知らせるイベント
        'App\Events\MaintainModeDetectionEvent' => [
            'App\Listeners\MaintainModeRecordListener',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
