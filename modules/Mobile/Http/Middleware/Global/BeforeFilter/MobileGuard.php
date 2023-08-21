<?php

namespace Modules\Mobile\Http\Middleware\Global\BeforeFilter;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MobileGuard
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        Auth::shouldUse('mobile');

        return $next($request);
    }
}
