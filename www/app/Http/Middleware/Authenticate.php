<?php

namespace App\Http\Middleware;

use Closure;

class Authenticate
{
    public function handle($request, Closure $next, $guard = null)
    {
        if (!user()) {
            abort(401);
        }

        return $next($request);
    }
}
