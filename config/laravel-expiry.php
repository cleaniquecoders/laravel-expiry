<?php

use CleaniqueCoders\LaravelExpiry\Events\ExpiredAccount;
use CleaniqueCoders\LaravelExpiry\Events\ExpiredPassword;
use CleaniqueCoders\LaravelExpiry\Listeners\LogoutOnExpired;

return [
    'events' => [
        ExpiredAccount::class => [
            LogoutOnExpired::class,
        ],
        ExpiredPassword::class => [
            LogoutOnExpired::class,
        ],
    ],
];
