<?php

namespace Modules\Customer\Http\Middleware\Global\BeforeFilter;

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
        /** @phpstan-ignore-next-line */
        app()->setLocale('ja');

        return $next($request);
    }
}
