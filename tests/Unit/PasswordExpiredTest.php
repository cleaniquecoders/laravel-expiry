<?php

namespace CleaniqueCoders\LaravelExpiry\Tests\Unit;

use CleaniqueCoders\LaravelExpiry\Http\Middleware\PasswordExpiry;
use CleaniqueCoders\LaravelExpiry\Tests\Stubs\Models\User;
use CleaniqueCoders\LaravelExpiry\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PasswordExpiredTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function users_table_has_password_expired_at_field()
    {
        $this->assertHasTable('users');
        $this->assertTableHasColumns('users', ['password_expired_at']);
    }

    /** @test */
    public function auto_logout_on_password_expired()
    {
        $user = User::create([
            'name'                => 'Expired Account',
            'email'               => 'expired@account.com',
            'password'            => 'password',
            'password_expired_at' => '2020-01-01 00:00:00',
        ]);

        $this->actingAs($user);
        $this->assertTrue(! empty(auth()->user()));
        $this->callMiddleware();
        $this->assertTrue(empty(auth()->user()));
    }

    protected function callMiddleware()
    {
        $this->call('GET', $this->app->make('router')->get('/__middleware__', [
            'middleware' => PasswordExpiry::class,
            function () {
                return '__passed__';
            },
        ])->uri(), []);
    }
}
