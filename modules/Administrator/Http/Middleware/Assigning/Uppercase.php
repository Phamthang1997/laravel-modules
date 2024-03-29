<?php

namespace Modules\Administrator\Http\Middleware\Assigning;

use Closure;
use Illuminate\Http\Request;

class Uppercase
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
        return $next($request);
    }
}
