<?php

namespace Modules\Administrator\Http\Middleware\Global\BeforeFilter;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdministratorGuard
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
        Auth::shouldUse('administrator');

        return $next($request);
    }
}
