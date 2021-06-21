<?php

namespace App\Providers;

use App\Models\Customer;
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
        $this->app->bind('App\ExceptionsHandlers\ApiGeneralExceptionHandler\ApiGeneralExceptionHandlerContract', function ($app) {
            return new \App\ExceptionsHandlers\ApiGeneralExceptionHandler\JsonApiGeneralExceptionHandler();
        });

        $this->app->bind('App\ExceptionsHandlers\ApiValidationExceptionHandler\ApiValidationExceptionHandlerContract', function ($app) {
            return new \App\ExceptionsHandlers\ApiValidationExceptionHandler\JsonApiValidationExceptionHandler();
        });

        $this->app->bind('App\Filters\CustomerFilter\CustomerFilterContract', function ($app) {
            return new \App\Filters\CustomerFilter\SqliteCustomerFilter(new Customer());
        });

        $this->app->bind('App\Services\QueryResultsFilters\Customer\CustomerQueryResultsFilterContract', function ($app) {
            return new \App\Services\QueryResultsFilters\Customer\CustomerFilter();
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
