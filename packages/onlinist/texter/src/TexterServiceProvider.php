<?php

namespace Onlinist\Texter;

use Illuminate\Support\ServiceProvider;

class TexterServiceProvider extends ServiceProvider {

    /**
     * Perform post-registration booting of services.
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
     * Register any package services.
     *
     * @return void
     */
    public function register() {
        $this->mergeConfigFrom(__DIR__ . '/../config/texter.php', 'texter');

        // Register the service the package provides.
        $this->app->singleton('texter', function ($app) {
            return new Texter;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides() {
        return ['texter'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole() {
        // Publishing the configuration file.
        $this->publishes([__DIR__ . '/../config/texter.php' => config_path('texter.php'),], 'texter.config');
    }

}
