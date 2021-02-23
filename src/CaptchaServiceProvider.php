<?php

namespace Jncinet\EmailCaptcha;

use Illuminate\Support\ServiceProvider;

class CaptchaServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../resources/lang' => resource_path('lang/vendor/email-captcha'),
                __DIR__ . '/../resources/views' => resource_path('views/vendor/email-captcha'),
            ]);
        }
        $this->loadRoutesFrom(__DIR__ . '/../routes.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'email-captcha');
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'email-captcha');
    }
}