<?php

namespace Nzsakib\DbConfig;

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
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'db-config');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'db-config');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

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

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/db-config'),
            ], 'lang');*/

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
        $newConfigs = (new DbConfig())->get();

        $this->app->config->set($newConfigs);
    }
}
