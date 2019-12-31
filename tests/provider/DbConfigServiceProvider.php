<?php

namespace Nzsakib\DbConfig\Tests\provider;

use Nzsakib\DbConfig\DbConfig;
use Illuminate\Support\ServiceProvider;

class DbConfigServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */

        $this->loadViewsFrom(__DIR__ . '/../../src/resources/views', 'db-config');

        $this->loadRoutesFrom(__DIR__ . '/../../src/routes/web.php');
        // $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../../config/config.php', 'db-config');

        // Register the main class to use with the facade
        $this->app->singleton('db-config', function () {
            return new DbConfig;
        });
    }

    /**
     * Insert new configuration into the service container
     *
     * @return void
     */
    protected function insertNewConfiguration()
    {
        //
    }
}
