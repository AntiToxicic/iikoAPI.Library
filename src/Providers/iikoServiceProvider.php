<?php

namespace IikoApiLibrary\Providers;

use Illuminate\Support\ServiceProvider;
use IikoApiLibrary\iiko\api\iikoClient;

class iikoServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/iikoapi.php', 'iikoapi'
        );

        $this->app->singleton('iikoClient', function ($app) {
            return new iikoClient(
                $app['config']->get('iikoapi.login'),
                $app['config']->get('iikoapi.base_url'));
        });
    }

    /**z
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../Http/Resources' => public_path('Http/Resources/vendor/iikoapilibrary')
            ], 'iikoapi-resources');

            $this->publishes([
                __DIR__ . '/../config/iikoapi.php' => config_path('iikoapi.php')
            ], 'iikoapi-config');
        }
    }
}
