<?php

use Illuminate\Routing\Router;

// 接口
Route::group([
    'namespace' => 'Jncinet\EmailCaptcha\Controllers\Api',
    'middleware' => ['api'],
], function (Router $router) {
    $router->post('email-captcha', 'SendCaptchaController@send')
        ->name('email.captcha');
});

// 后台
Route::group([
    'prefix' => config('admin.route.prefix') . '/email-captcha',
    'namespace' => 'Jncinet\EmailCaptcha\Controllers\Admin',
    'middleware' => config('admin.route.middleware'),
    'as' => 'admin.email-captcha.'
], function (Router $router) {
    // 邮箱配置
    $router->get('config', 'ConfigController@index')
        ->name('config');
});