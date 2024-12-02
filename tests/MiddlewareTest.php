<?php

use Illuminate\Routing\Router;

it('registers middleware automatically', function () {
    $router = app(Router::class);

    expect($router->getMiddleware())->toHaveKey('account.expiry');
    expect($router->getMiddleware()['account.expiry'])
        ->toBe(\CleaniqueCoders\LaravelExpiry\Http\Middleware\AccountExpiry::class);

    expect($router->getMiddleware())->toHaveKey('password.expiry');
    expect($router->getMiddleware()['password.expiry'])
        ->toBe(\CleaniqueCoders\LaravelExpiry\Http\Middleware\PasswordExpiry::class);
});
