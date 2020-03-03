<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1'], function () {
    // パンくずリスト
    Route::get('breadcrumbs', 'BreadcrumbsController@index')->name('breadcrumbs.index');
    // サイトマップ
    Route::get('sitemap', 'SitemapController@index')->name('sitemap.index');

    // pages
    Route::group(['prefix' => 'pages'], function () {
        // 個人ページ
        Route::get('{user}', 'Pages\PageController@show')->name('pages.page.show');
        // 作品一覧
        Route::get('{user}/storages', 'Pages\StorageController@index')->name('pages.storage.index');
        // 作品ページ
        Route::get('{user}/storages/{storage_id}', 'Pages\StorageController@show')->name('pages.storage.show');
    });

    // 認証に通った場合
    Route::group(['middleware' => 'auth:api'], function () {
        // ログアウト
        Route::post('logout', 'Auth\LoginController@logout')->name('logout');

        // TODO 必要ないと判断できたら削除
        Route::get('/user', function (Request $request) {
            return $request->user();
        });

        // プロフィール一覧
        Route::get('profiles', 'Pages\ProfileController@index')->name('pages.profile.index');
        // ストレージ一覧
        Route::get('storages', 'Pages\StorageController@all')->name('pages.storage.all');

        Route::group(['prefix' => 'users'], function () {
            // ユーザー削除
            Route::delete('', 'Users\UserController@destory')->name('user.destory');
            // 作品の一覧・追加・取得・編集・削除
            Route::apiResource('storage', 'Users\StorageController')->names([
                'index'   => 'user.storage.index',
                'store'   => 'user.storage.store',
                'show'    => 'user.storage.show',
                'update'  => 'user.storage.update',
                'destroy' => 'user.storage.destroy',
            ]);

            // 自分のプロフィール取得・編集
            Route::get('profile', 'Users\ProfileController@show')->name('user.profile.show');
            Route::patch('profile', 'Users\ProfileController@update')->name('user.profile.update');

            // 自分のポートフォリオ取得・編集
            Route::get('page', 'Users\PageController@show')->name('user.page.show');
            Route::patch('page', 'Users\PageController@update')->name('user.page.update');
        });

        // TODO 必要ないと判断できたら削除
        Route::patch('settings/profile', 'Settings\ProfileController@update');
        // TODO 必要ないと判断できたら削除
        Route::patch('settings/password', 'Settings\PasswordController@update');
    });

    // 未認証の場合
    Route::group(['middleware' => 'guest:api'], function () {
        Route::post('login', 'Auth\LoginController@login')->name('login');
        Route::post('register', 'Auth\RegisterController@register')->name('register');

        Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
        Route::post('password/reset', 'Auth\ResetPasswordController@reset');

        Route::post('email/verify/{user}', 'Auth\VerificationController@verify')->name('verification.verify');
        Route::post('email/resend', 'Auth\VerificationController@resend');

        Route::post('oauth/{driver}', 'Auth\OAuthController@redirectToProvider');
        Route::get('oauth/{driver}/callback', 'Auth\OAuthController@handleProviderCallback')->name('oauth.callback');
    });
});
