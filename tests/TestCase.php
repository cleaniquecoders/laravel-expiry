<?php

namespace CleaniqueCoders\LaravelExpiry\Tests;

use CleaniqueCoders\LaravelExpiry\LaravelExpiryServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;

use function Orchestra\Testbench\workbench_path;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Workbench\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelExpiryServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        $migration = include workbench_path('database/migrations/2014_10_12_000000_create_users_table.php');
        $migration->up();

        $migration = include __DIR__.'/../database/migrations/add_expiry_columns.php.stub';
        $migration->up();
    }
}
