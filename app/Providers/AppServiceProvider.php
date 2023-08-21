<?php

namespace App\Providers;

use App\Http\Middleware\Maintenance;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->register(ModuleServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //@phpstan-ignore-next-line
        app(Kernel::class)->pushMiddleware(Maintenance::class);
    }
}
