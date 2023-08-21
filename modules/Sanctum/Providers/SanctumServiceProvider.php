<?php

declare(strict_types=1);

namespace Modules\Sanctum\Providers;

use Laravel\Sanctum\Sanctum;
use Illuminate\Support\ServiceProvider;
use Modules\Sanctum\Models\PersonalAccessToken;
use App\Traits\Provider\ProviderCommonFunctions;

class SanctumServiceProvider extends ServiceProvider
{
    use ProviderCommonFunctions;

    /**
     * Register any application services.
     *
     * @var array<string>
     */
    protected array $providers = [
        SanctumGuardProvider::class
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
        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
    }
}