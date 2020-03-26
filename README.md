
[![Build Status](https://travis-ci.org/cleaniquecoders/laravel-expiry.svg?branch=master)](https://travis-ci.org/cleaniquecoders/laravel-expiry) [![Latest Stable Version](https://poser.pugx.org/cleaniquecoders/laravel-expiry/v/stable)](https://packagist.org/packages/cleaniquecoders/laravel-expiry) [![Total Downloads](https://poser.pugx.org/cleaniquecoders/laravel-expiry/downloads)](https://packagist.org/packages/cleaniquecoders/laravel-expiry) [![License](https://poser.pugx.org/cleaniquecoders/laravel-expiry/license)](https://packagist.org/packages/cleaniquecoders/laravel-expiry)

## Laravel Expiry

Enable expiry on user's account and user's password.

## Installation

1. In order to install `cleaniquecoders/laravel-expiry` in your Laravel project, just run the *composer require* command from your terminal:

```
$ composer require cleaniquecoders/laravel-expiry
```

2. Then publish and run the migration files:

```
$ php artisan vendor:publish --tag=laravel-expiry-migrations
$ php artisan migrate
```

3. Register route middlewares in `app/Http/Kernel.php`:

```php 
'account.expiry' => \CleaniqueCoders\LaravelExpiry\Http\Middleware\AccountExpiry::class,
'password.expiry' => \CleaniqueCoders\LaravelExpiry\Http\Middleware\PasswordExpiry::class,
```

4. Now you may use the middleware in your application:

```php 
Route::middleware(['account.expiry', 'password.expiry'])
	->get('/somewhere-not-expired');
```

## Usage

## Test

Run the following command:

```
$ vendor/bin/phpunit  --testdox --verbose
```

## Contributing

Thank you for considering contributing to the `cleaniquecoders/laravel-expiry`!

### Bug Reports

To encourage active collaboration, it is strongly encourages pull requests, not just bug reports. "Bug reports" may also be sent in the form of a pull request containing a failing test.

However, if you file a bug report, your issue should contain a title and a clear description of the issue. You should also include as much relevant information as possible and a code sample that demonstrates the issue. The goal of a bug report is to make it easy for yourself - and others - to replicate the bug and develop a fix.

Remember, bug reports are created in the hope that others with the same problem will be able to collaborate with you on solving it. Do not expect that the bug report will automatically see any activity or that others will jump to fix it. Creating a bug report serves to help yourself and others start on the path of fixing the problem.

## Coding Style

`cleaniquecoders/laravel-expiry` follows the PSR-2 coding standard and the PSR-4 autoloading standard. 

You may use PHP CS Fixer in order to keep things standardised. PHP CS Fixer configuration can be found in `.php_cs`.

## License

This package is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).