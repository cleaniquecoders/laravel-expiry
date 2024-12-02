<?php

use CleaniqueCoders\LaravelExpiry\Events\ExpiredAccount;
use CleaniqueCoders\LaravelExpiry\Http\Middleware\AccountExpiry;
use CleaniqueCoders\LaravelExpiry\Listeners\LogoutOnExpired;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Workbench\App\Models\User;

use function Orchestra\Testbench\artisan;

uses(RefreshDatabase::class);

beforeEach(function () {
    artisan($this, 'migrate');

    Event::fake();  // Prevent actual event dispatching
});

it('fires ExpiredAccount event if account is expired', function () {
    Event::fake();

    // Simulate an authenticated user whose account is expired
    $user = User::factory()->create(['account_expired_at' => now()->subDay()]);
    Auth::login($user);

    $middleware = new AccountExpiry;

    // Handle the request through middleware
    $request = new Request;
    $middleware->handle($request, fn () => null);

    // Assert that the ExpiredAccount event was fired
    Event::assertDispatched(ExpiredAccount::class, function ($event) use ($user) {
        return $event->user->is($user);
    });
});

it('logs out the user when handling ExpiredAccount event', function () {
    // Simulate an authenticated user
    $user = User::factory()->create();
    Auth::login($user);

    // Assert the user is logged in
    expect(Auth::check())->toBeTrue();

    // Handle the event with the listener
    $listener = new LogoutOnExpired;
    $listener->handle(new ExpiredAccount($user));

    // Assert the user is logged out
    expect(Auth::check())->toBeFalse();
});
