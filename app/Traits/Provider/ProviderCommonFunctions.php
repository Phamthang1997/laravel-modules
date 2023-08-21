<?php

declare(strict_types=1);

namespace App\Traits\Provider;

use Illuminate\Support\Facades\File;
use Symfony\Component\Finder\SplFileInfo;

trait ProviderCommonFunctions
{
    /**
     * Register depended providers
     *
     * @return void
     */
    public function registerProviders(): void
    {
        //@phpstan-ignore-next-line
        if (empty($this->app) || empty($this->providers)) {
            return;
        }
        foreach ($this->providers as $provider) {
            $this->app->register($provider);
        }
    }
}
