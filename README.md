[![Latest Version on Packagist](https://img.shields.io/packagist/v/cleaniquecoders/laravel-expiry.svg?style=flat-square)](https://packagist.org/packages/cleaniquecoders/laravel-expiry) [![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/cleaniquecoders/laravel-expiry/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/cleaniquecoders/laravel-expiry/actions?query=workflow%3Arun-tests+branch%3Amain) [![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/cleaniquecoders/laravel-expiry/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/cleaniquecoders/laravel-expiry/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain) [![Total Downloads](https://img.shields.io/packagist/dt/cleaniquecoders/laravel-expiry.svg?style=flat-square)](https://packagist.org/packages/cleaniquecoders/laravel-expiry)

## Laravel Expiry

Enable expiry on user's account and user's password.

## Installation

In order to install `cleaniquecoders/laravel-expiry` in your Laravel project, just run the *composer require* command from your terminal:

```bash
composer require cleaniquecoders/laravel-expiry
```

Then publish and run the migration files:

```bash
php artisan vendor:publish --tag=laravel-expiry-migrations
php artisan migrate
```

Register route middlewares in `app/Http/Kernel.php`:

```php
'account.expiry' => \CleaniqueCoders\LaravelExpiry\Http\Middleware\AccountExpiry::class,
'password.expiry' => \CleaniqueCoders\LaravelExpiry\Http\Middleware\PasswordExpiry::class,
```

## Usage

Now you may use the middleware in your application:

```php
Route::middleware(['account.expiry', 'password.expiry'])
 ->get('/somewhere-not-expired');
```

You can listen to the following events on account and password expiry:

```php
use CleaniqueCoders\LaravelExpiry\Events\ExpiredAccount;
use CleaniqueCoders\LaravelExpiry\Events\ExpiredPassword;
```

## Test

Run the following command:

```bash
vendor/bin/phpunit  --testdox --verbose
```

## Contributing

Thank you for considering contributing to the `cleaniquecoders/laravel-expiry`!

### Bug Reports

To encourage active collaboration, it is strongly encourages pull requests, not just bug reports. "Bug reports" may also be sent in the form of a pull request containing a failing test.

However, if you file a bug report, your issue should contain a title and a clear description of the issue. You should also include as much relevant information as possible and a code sample that demonstrates the issue. The goal of a bug report is to make it easy for yourself - and others - to replicate the bug and develop a fix.

Remember, bug reports are created in the hope that others with the same problem will be able to collaborate with you on solving it. Do not expect that the bug report will automatically see any activity or that others will jump to fix it. Creating a bug report serves to help yourself and others start on the path of fixing the problem.

## Coding Style

`cleaniquecoders/laravel-expiry` follows the PSR-2 coding standard and the PSR-4 autoloading standard.

## License

This package is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
