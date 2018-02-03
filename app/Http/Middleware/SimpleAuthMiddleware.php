<?php

namespace App\Http\Middleware;

use Closure;

class SimpleAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return return Auth::onceBasic('username') ?: $next($request);;
    }
}
