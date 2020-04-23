<?php

namespace App\Http\Middleware;

use App\Events\AccessApiDetectionEvent;
use Auth;
use Closure;

class RecordIpAndRoute
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
        event(new AccessApiDetectionEvent($request->ip(), Auth::check(), $request->method().':'.$request->fullUrl()));
        return $next($request);
    }
}
