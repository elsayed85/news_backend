<?php

namespace App\Http\Middleware;

use Closure;

class APIVersion
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next , $verision)
    {
        config(['app.api.version' => $verision]);
        return $next($request);
    }
}
