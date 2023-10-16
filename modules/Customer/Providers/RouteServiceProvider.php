<?php

declare(strict_types=1);

namespace Modules\Customer\Providers;

use App\Enums\ModulesPrefix;
use App\Traits\Provider\Contracts\WithModuleProvider;
use App\Traits\Provider\Contracts\WithRouteProvider;
use App\Traits\Provider\HasModuleProvider;
use App\Traits\Provider\HasRouteProvider;
use Illuminate\Cache\RateLimiting\Limit;
use App\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class RouteServiceProvider extends ServiceProvider implements WithModuleProvider, WithRouteProvider
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
        $this->setIsPrefix(true);

        $this->routes(function () {
            $this->registerModuleRouteFromPaths(
                ['web'],
                $this->getRoutePrefix(ModulesPrefix::Customer->value),
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
        RateLimiter::for(config('customer.rate.limit.name'), function (Request $request) {
            /** @phpstan-ignore-next-line */
            return Limit::perMinute(config('customer.rate.limit.attempts.minutes'))->by($request->user()?->id ?: $request->ip());
        });
    }
}