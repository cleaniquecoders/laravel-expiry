<?php

namespace CleaniqueCoders\LaravelExpiry\Listeners;

use CleaniqueCoders\LaravelExpiry\Events\ExpiredAccount;
use CleaniqueCoders\LaravelExpiry\Events\ExpiredPassword;
use Illuminate\Support\Facades\Auth;

class LogoutOnExpired
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ExpiredAccount|ExpiredPassword $event): void
    {
        Auth::logout();
    }
}
