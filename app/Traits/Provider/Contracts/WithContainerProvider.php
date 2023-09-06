<?php

namespace App\Traits\Provider\Contracts;

interface WithContainerProvider
{
    /**
     * Register any application services <Services, Repositories>.
     *
     * @return void
     */
    public function registerContainer(): void;

    /**
     * Bind the result as a specific type of binding.
     *
     * @param  string  $type
     *
     * @return static
     */
    public function setBindingType(string $type): static;
}
