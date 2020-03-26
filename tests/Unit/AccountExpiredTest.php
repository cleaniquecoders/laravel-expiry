<?php

namespace CleaniqueCoders\LaravelExpiry\Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use CleaniqueCoders\LaravelExpiry\Tests\TestCase;

class AccountExpiredTest extends TestCase
{
	use RefreshDatabase;

	/** @test */
	public function users_table_has_account_expired_at_field()
	{
		$this->assertHasTable('users');
		$this->assertTableHasColumns('users', ['account_expired_at']);
	}
}