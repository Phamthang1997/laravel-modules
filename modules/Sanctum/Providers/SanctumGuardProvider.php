<?php

declare(strict_types=1);

namespace Modules\Sanctum\Providers;

use Illuminate\Auth\RequestGuard;
use Illuminate\Contracts\Auth\Factory;
use Laravel\Sanctum\SanctumServiceProvider;
use Modules\Sanctum\Guard\SanctumGuard;

class SanctumGuardProvider extends SanctumServiceProvider
{
    /**
     * Register the guard.
     *
     * @param Factory $auth
     * @param array $config
     * @return RequestGuard
     */
    protected function createGuard($auth, $config): RequestGuard // @phpstan-ignore-line
    {
        return new RequestGuard(
        /** @phpstan-ignore-next-line */
            new SanctumGuard($auth, config('sanctum.token.lifetime.access'), $config['provider']),
            /** @phpstan-ignore-next-line */
            request(),
            /** @phpstan-ignore-next-line */
            $auth->createUserProvider($config['provider'] ?? null)
        );
    }
}