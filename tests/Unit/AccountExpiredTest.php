<?php

namespace CleaniqueCoders\LaravelExpiry\Tests\Unit;

use CleaniqueCoders\LaravelExpiry\Events\ExpiredAccount;
use CleaniqueCoders\LaravelExpiry\Http\Middleware\AccountExpiry;
use CleaniqueCoders\LaravelExpiry\Tests\Stubs\Models\User;
use CleaniqueCoders\LaravelExpiry\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;

class AccountExpiredTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function users_table_has_account_expired_at_field()
    {
        $this->assertHasTable('users');
        $this->assertTableHasColumns('users', ['account_expired_at']);
    }

    /** @test */
    public function it_trigger_expired_account_event_when_account_expired()
    {
        Event::fake();

        $user = User::create([
            'name'               => 'Expired Account',
            'email'              => 'expired@account.com',
            'password'           => 'password',
            'account_expired_at' => '2020-01-01 00:00:00',
        ]);

        $this->actingAs($user);

        $this->callMiddleware();

        Event::assertDispatched(ExpiredAccount::class, function ($event) use ($user) {
            return $event->user->id === $user->id;
        });
    }

    /** @test */
    public function auto_logout_on_account_expired()
    {
        $user = User::create([
            'name'               => 'Expired Account',
            'email'              => 'expired@account.com',
            'password'           => 'password',
            'account_expired_at' => '2020-01-01 00:00:00',
        ]);

        $this->actingAs($user);
        $this->assertTrue(! empty(auth()->user()));
        $this->callMiddleware();
        $this->assertTrue(empty(auth()->user()));
    }

    protected function callMiddleware()
    {
        $this->call('GET', $this->app->make('router')->get('/__middleware__', [
            'middleware' => AccountExpiry::class,
            function () {
                return '__passed__';
            },
        ])->uri(), []);
    }
}
