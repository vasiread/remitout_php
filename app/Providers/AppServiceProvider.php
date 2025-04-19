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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (
            isset($_SERVER['HTTP_HOST']) &&
            !str_contains($_SERVER['HTTP_HOST'], 'localhost')
        ) {
            \URL::forceScheme('https');
        }
    }
}