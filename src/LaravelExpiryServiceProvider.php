<?php

namespace CleaniqueCoders\LaravelExpiry;

use Spatie\LaravelPackageTools\PackageServiceProvider;
use Spatie\LaravelPackageTools\Package;

class LaravelExpiryServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-expiry')
            ->hasMigration('add_expiry_columns');
    }
}
