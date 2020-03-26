<?php

namespace CleaniqueCoders\LaravelExpiry\Tests\Unit;

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
}