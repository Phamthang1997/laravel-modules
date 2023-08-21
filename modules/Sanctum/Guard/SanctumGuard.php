<?php

declare(strict_types=1);

namespace Modules\Sanctum\Guard;

use Modules\Sanctum\Enums\TokenType;
use Modules\Sanctum\Exceptions\TokenExceptions;
use Modules\Sanctum\Traits\HasSanctumExceptions;
use Laravel\Sanctum\Guard as BaseSanctumGuard;

class SanctumGuard extends BaseSanctumGuard
{
    use HasSanctumExceptions;

    /**
     * Determine if the provided access token is valid.
     *
     * @param mixed $accessToken
     * @return bool
     * @throws TokenExceptions
     */
    protected function isValidAccessToken(mixed $accessToken): bool
    {
        if (! $accessToken) {
            return false;
        }
        /** @phpstan-ignore-next-line */
        if ($accessToken->expires_at->isPast() || $accessToken->token_type === TokenType::Refresh->value) {
            $this->handleSanctumExceptions($accessToken->token_type);// @phpstan-ignore-line
        }

        return parent::isValidAccessToken($accessToken);
    }
}
