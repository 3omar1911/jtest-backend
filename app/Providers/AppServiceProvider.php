<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\ExceptionsHandlers\ApiGeneralExceptionHandler', function ($app) {
            return new \App\ExceptionsHandlers\JsonApiGeneralExceptionHandlerContract();
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
