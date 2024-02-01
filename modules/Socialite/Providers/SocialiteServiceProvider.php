<?php

namespace Modules\Socialite\Providers;

use App\Traits\Provider\Contracts\WithProviderCommonFunctions;
use App\Traits\Provider\HasModuleProvider;
use App\Traits\Provider\ProviderCommonFunctions;
use Illuminate\Support\ServiceProvider;

class SocialiteServiceProvider extends ServiceProvider implements WithProviderCommonFunctions
{
    use ProviderCommonFunctions;
    use HasModuleProvider;

    /**
     * Register any application services.
     *
     * @var array<string>
     */
    protected array $providers = [
        RouteServiceProvider::class,
    ];
}