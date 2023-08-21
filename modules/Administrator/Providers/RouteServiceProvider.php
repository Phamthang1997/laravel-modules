<?php

declare(strict_types=1);

namespace Modules\Administrator\Providers;

use App\Traits\Provider\HasModuleProvider;
use App\Traits\Provider\HasRouteProvider;
use Illuminate\Cache\RateLimiting\Limit;
use App\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class RouteServiceProvider extends ServiceProvider
{
    use HasModuleProvider;
    use HasRouteProvider;

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        //Configure limiters web
        $this->configureRateLimiting();
        $this->setRootDir(__DIR__);

        $this->routes(function () {
            /** @phpstan-ignore-next-line */
            $routeName = strtolower($this->getModuleName());
            $this->registerModuleRouteFromPaths(
                ['web'],
                $this->getRoutePrefix($routeName),
                $this->getRouteFilePath('web.php')
            );
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting(): void
    {
        /** @phpstan-ignore-next-line */
        RateLimiter::for(config('administrator.rate.limit.name'), function (Request $request) {
            /** @phpstan-ignore-next-line */
            return Limit::perMinute(config('administrator.rate.limit.attempts.minutes'))->by($request->user()?->id ?: $request->ip());
        });
    }
}