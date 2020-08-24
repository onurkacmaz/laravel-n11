<?php

namespace Onurkacmaz\LaravelN11;

use Illuminate\Support\ServiceProvider;

class LaravelN11ServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/laravel-n11.php' => config_path('laravel-n11.php'),
        ], 'config');
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->singleton(LaravelN11ServiceProvider::class, function (Application $app) {
            return new LaravelN11ServiceProvider();
        });
        $this->mergeConfigFrom(
            __DIR__.'/../config/laravel-n11.php', 'laravel-n11'
        );
    }
}
