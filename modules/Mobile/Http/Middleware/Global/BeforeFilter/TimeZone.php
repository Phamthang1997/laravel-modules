<?php

namespace Modules\Mobile\Http\Middleware\Global\BeforeFilter;

use Closure;
use Illuminate\Http\Request;
use Modules\Mobile\Enums\TimeName;

class TimeZone
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
        date_default_timezone_set(TimeName::getTimezone('vn'));

        return $next($request);
    }
}
