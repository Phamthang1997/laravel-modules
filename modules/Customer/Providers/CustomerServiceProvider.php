<?php

declare(strict_types=1);

namespace Modules\Customer\Providers;

use App\Traits\Provider\Contracts\WithProviderCommonFunctions;
use App\Traits\Provider\ProviderCommonFunctions;
use Illuminate\Support\ServiceProvider;

class CustomerServiceProvider extends ServiceProvider implements WithProviderCommonFunctions
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