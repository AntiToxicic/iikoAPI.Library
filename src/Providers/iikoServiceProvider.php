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
        $this->app->bind('iikoClient', function (){
            return new iikoClient(env('IIKO_API_LOGIN'));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
