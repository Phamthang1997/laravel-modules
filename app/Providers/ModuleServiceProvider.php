<?php

namespace App\Providers;

use App\Traits\Provider\HasModuleProvider;
use App\Traits\Provider\ProviderCommonFunctions;
use Carbon\Laravel\ServiceProvider;
use Modules\Administrator\Providers\AdministratorServiceProvider;
use Modules\Customer\Providers\CustomerServiceProvider;
use Modules\Mobile\Providers\MobileServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    use HasModuleProvider;
    use ProviderCommonFunctions;

    /**
     * Register any application services.
     *
     * @var array<string>
     */
    protected array $providers = [
        AdministratorServiceProvider::class,
        CustomerServiceProvider::class,
        MobileServiceProvider::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //Register Providers Module
        $this->registerProviders();

        //Register Folder Module
        $this->bootModule();
    }
}