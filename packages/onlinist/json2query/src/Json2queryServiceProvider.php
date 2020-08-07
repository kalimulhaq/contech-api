<?php

namespace Onlinist\Json2query;

use Illuminate\Support\ServiceProvider;
use Onlinist\Json2query\Services\Json2query;

class Json2queryServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot() {
        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {
        $this->mergeConfigFrom(__DIR__ . '/../config/json2query.php', 'json2query');

        $this->app->bind('json2query', function () {
            return new Json2query();
        });

        // Register the service the package provides.
        $this->app->singleton('json2query', function ($app) {
            return new Json2query;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides() {
        return ['json2query'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole() {
        // Publishing the configuration file.
        // $this->publishes([__DIR__ . '/../config/json2query.php' => config_path('json2query.php'),], 'json2query.config');
    }

}
