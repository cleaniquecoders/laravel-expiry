<?php

namespace CleaniqueCoders\LaravelExpiry\Tests\Stubs\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $guarded = ['id'];

    protected $dates = [
        'account_expired_at',
        'password_expired_at',
    ];
}
