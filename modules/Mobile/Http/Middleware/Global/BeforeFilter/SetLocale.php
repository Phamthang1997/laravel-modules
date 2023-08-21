<?php

namespace Modules\Mobile\Http\Middleware\Global\BeforeFilter;

use Closure;
use Illuminate\Http\Request;

class SetLocale
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
        app()->setLocale('en');// @phpstan-ignore-line

        return $next($request);
    }
}
