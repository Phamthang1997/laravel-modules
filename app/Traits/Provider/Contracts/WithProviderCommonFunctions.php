<?php

namespace App\Traits\Provider\Contracts;

interface WithProviderCommonFunctions
{
    /**
     * Register depended providers
     *
     * @return void
     */
    public function registerProviders(): void;
}
