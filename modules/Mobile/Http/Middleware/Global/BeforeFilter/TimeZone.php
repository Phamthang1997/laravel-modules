<?php

namespace Modules\Mobile\Http\Middleware\Global\BeforeFilter;

use Closure;
use Illuminate\Http\Request;

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
        date_default_timezone_set('Asia/Ho_Chi_Minh');

        return $next($request);
    }
}
