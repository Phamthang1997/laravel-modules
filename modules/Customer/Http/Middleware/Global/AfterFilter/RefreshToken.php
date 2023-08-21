<?php

namespace Modules\Customer\Http\Middleware\Global\AfterFilter;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RefreshToken
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
        // Check if the user has a refresh token
        if (Auth::check()) {
            /** @phpstan-ignore-next-line */
            Auth::user()->update([
                'updated_at' => Carbon::now(),
            ]);
        }

        return $next($request);
    }
}
