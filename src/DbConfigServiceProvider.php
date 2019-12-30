<?php

namespace Nzsakib\DbConfig;

use Illuminate\Support\Arr;
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

        $this->loadViewsFrom(__DIR__ . '/resources/views', 'db-config');

        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('db-config.php'),
            ], 'config');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/db-config'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/db-config'),
            ], 'assets');*/

            // Registering package commands.
            // $this->commands([]);
            $this->insertNewConfiguration();
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'db-config');

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
        // $config = (new DbConfig())->get();
        // $toMerge = Arr::dot($config);

        // foreach ($toMerge as $key => $value) {
        //     config()->set($key, $value);
        // }
    }
}
