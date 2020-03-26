<?php

namespace CleaniqueCoders\LaravelExpiry;

use Illuminate\Support\ServiceProvider;

class LaravelExpiryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../database/migrations/' => database_path('migrations')
        ], 'laravel-expiry-migrations');
    }

    /**
     * Register the application services.
     */
    public function register()
    {
    }
}
