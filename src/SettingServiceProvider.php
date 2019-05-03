<?php

namespace Soumen\Setting;

use Illuminate\Support\ServiceProvider;

class SettingServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->publishes([
            __DIR__.'/../config/setting.php' => config_path('laravel-setting.php'),
        ], 'config');
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        // Register the service the package provides.
        $this->app->singleton('setting', function ($app) {
            return new Setting;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['setting'];
    }
}
