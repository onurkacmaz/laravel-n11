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

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('laravel-n11.php'),
            ], 'config');

            // Registering package commands.
            // $this->commands([]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {

        // Register the main class to use with the facade
        $this->app->singleton(LaravelN11ServiceProvider::class, function (Application $app) {
            return new LaravelN11ServiceProvider();
        });
    }
}
