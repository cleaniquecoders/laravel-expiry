<?php

namespace CleaniqueCoders\LaravelExpiry\Http\Middleware;

use Closure;

class AccountExpiry
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (now()->greaterThan(auth()->user()->account_expired_at)) {
            event(
                new \CleaniqueCoders\LaravelExpiry\Events\ExpiredAccount(auth()->user())
            );
            auth()->logout();

            throw new \CleaniqueCoders\LaravelExpiry\Exceptions\ExpiredAccountException();
        }

        return $next($request);
    }
}
