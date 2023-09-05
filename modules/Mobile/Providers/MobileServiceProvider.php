<?php

declare(strict_types=1);

namespace Modules\Mobile\Providers;

use Illuminate\Support\ServiceProvider;
use App\Traits\Provider\ProviderCommonFunctions;
use Modules\Sanctum\Providers\SanctumServiceProvider;

class MobileServiceProvider extends ServiceProvider
{
    use ProviderCommonFunctions;

    /**
     * Register any application services.
     *
     * @var array<string>
     */
    protected array $providers = [
        RouteServiceProvider::class,
        ContainerServiceProvider::class,
        SanctumServiceProvider::class
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->registerProviders();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}