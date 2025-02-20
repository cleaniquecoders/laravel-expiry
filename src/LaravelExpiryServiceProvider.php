<?php

namespace CleaniqueCoders\LaravelExpiry;

use CleaniqueCoders\LaravelExpiry\Http\Middleware\AccountExpiry;
use CleaniqueCoders\LaravelExpiry\Http\Middleware\PasswordExpiry;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Event;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelExpiryServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-expiry')
            ->hasMigration('add_expiry_columns')
            ->hasConfigFile('laravel-expiry');
    }

    public function packageRegistered()
    {
        $events = config('laravel-expiry.events');

        foreach ($events as $event => $listeners) {
            foreach ($listeners as $listener) {
                Event::listen($event, $listener);
            }
        }
    }

    public function packageBooted()
    {
        $router = $this->app->make(Router::class);

        $router->aliasMiddleware('account.expiry', AccountExpiry::class);
        $router->aliasMiddleware('password.expiry', PasswordExpiry::class);
    }
}
