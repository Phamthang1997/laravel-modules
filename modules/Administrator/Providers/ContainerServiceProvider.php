<?php

declare(strict_types=1);

namespace Modules\Administrator\Providers;

use App\Traits\Provider\HasContainerProvider;
use App\Traits\Provider\HasModuleProvider;
use Illuminate\Support\ServiceProvider;

class ContainerServiceProvider extends ServiceProvider
{
    use HasModuleProvider;
    use HasContainerProvider;

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->setRootDir(__DIR__);
        $this->registerContainer();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}