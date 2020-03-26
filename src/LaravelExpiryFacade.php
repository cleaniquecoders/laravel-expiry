<?php

namespace CleaniqueCoders\LaravelExpiry;

/*
 * This file is part of laravel-expiry
 *
 * @license MIT
 * @package laravel-expiry
 */

use Illuminate\Support\Facades\Facade;

class LaravelExpiryFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'LaravelExpiry';
    }
}
