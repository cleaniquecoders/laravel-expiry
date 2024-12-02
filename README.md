# Laravel Expiry

[![Latest Version on Packagist](https://img.shields.io/packagist/v/cleaniquecoders/laravel-expiry.svg?style=flat-square)](https://packagist.org/packages/cleaniquecoders/laravel-expiry) [![PHPStan](https://github.com/cleaniquecoders/laravel-expiry/actions/workflows/phpstan.yml/badge.svg)](https://github.com/cleaniquecoders/laravel-expiry/actions/workflows/phpstan.yml) [![Run Tests](https://github.com/cleaniquecoders/laravel-expiry/actions/workflows/run-tests.yml/badge.svg)](https://github.com/cleaniquecoders/laravel-expiry/actions/workflows/run-tests.yml) [![Fix PHP Code Style Issues](https://github.com/cleaniquecoders/laravel-expiry/actions/workflows/fix-styling.yml/badge.svg)](https://github.com/cleaniquecoders/laravel-expiry/actions/workflows/fix-styling.yml) [![Total Downloads](https://img.shields.io/packagist/dt/cleaniquecoders/laravel-expiry.svg?style=flat-square)](https://packagist.org/packages/cleaniquecoders/laravel-expiry)

`cleaniquecoders/laravel-expiry` is a Laravel package that enables expiration for user accounts and passwords with seamless middleware and event-driven support.

---

## Features

- **Account Expiry**: Middleware to check and handle expired accounts.
- **Password Expiry**: Middleware to enforce password expiration policies.
- **Event Listeners**: Automatically trigger events when accounts or passwords expire.

---

## Installation

Install the package via Composer:

```bash
composer require cleaniquecoders/laravel-expiry
```

Publish and run the migration files to add the necessary expiry columns:

```bash
php artisan vendor:publish --tag=laravel-expiry-migrations
php artisan migrate
```

### Middleware Registration

The package automatically registers the following middleware in your application:

- **`account.expiry`**: Handles account expiry checks.
- **`password.expiry`**: Handles password expiry checks.

---

## Usage

### Apply Middleware

Use the middleware in your routes to enforce expiry checks:

```php
Route::middleware(['account.expiry', 'password.expiry'])->group(function () {
    Route::get('/protected-route', [SomeController::class, 'index']);
});
```

### Event Listeners

The package provides a configuration-driven approach to managing event listeners. By default, the following events and listeners are configured:

#### Default Event-to-Listener Mapping

The configuration (`config/laravel-expiry.php`) includes the following mappings:

```php
'events' => [
    \CleaniqueCoders\LaravelExpiry\Events\ExpiredAccount::class => [
        \CleaniqueCoders\LaravelExpiry\Listeners\LogoutOnExpired::class,
    ],
    \CleaniqueCoders\LaravelExpiry\Events\ExpiredPassword::class => [
        \CleaniqueCoders\LaravelExpiry\Listeners\LogoutOnExpired::class,
    ],
],
```

#### Handling Events

The package automatically registers these events and listeners. You can modify or extend the behaviour by updating the configuration file.

For example, when a user's account or password expires:

- The **`ExpiredAccount`** or **`ExpiredPassword`** event is triggered.
- The **`LogoutOnExpired`** listener handles these events by logging the user out.

#### Customising Listeners

To add custom listeners for these events, update the configuration file (`config/laravel-expiry.php`):

```php
'events' => [
    \CleaniqueCoders\LaravelExpiry\Events\ExpiredAccount::class => [
        \App\Listeners\YourCustomListener::class,
    ],
    \CleaniqueCoders\LaravelExpiry\Events\ExpiredPassword::class => [
        \App\Listeners\YourCustomListener::class,
    ],
],
```

With this setup, the package makes it easy to integrate custom logic for handling expiry events.

---

## Testing

To run the test suite, use the following command:

```bash
vendor/bin/pest --testdox
```

The package is fully tested with PestPHP to ensure reliability.

---

## Contributing

Thank you for considering contributing to `cleaniquecoders/laravel-expiry`. Contributions are welcome and appreciated!

### Reporting Bugs

If you find a bug, you can either:

- Submit a pull request with a failing test case.
- Create an issue describing the problem clearly with steps to reproduce it.

### Coding Style

The package follows **PSR-2** coding standards and **PSR-4** autoloading.

---

## License

This package is open-source software licensed under the [MIT license](http://opensource.org/licenses/MIT).
