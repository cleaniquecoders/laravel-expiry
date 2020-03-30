<?php

namespace CleaniqueCoders\LaravelExpiry\Http\Middleware;

use Closure;

class PasswordExpiry
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
        if (now()->greaterThan(auth()->user()->password_expired_at)) {
            event(
                new \CleaniqueCoders\LaravelExpiry\Events\ExpiredPassword(auth()->user())
            );
            auth()->logout();

            throw new \CleaniqueCoders\LaravelExpiry\Exceptions\ExpiredPasswordException();
        }

        return $next($request);
    }
}
