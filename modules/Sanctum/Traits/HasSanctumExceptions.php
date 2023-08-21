<?php

namespace Modules\Sanctum\Traits;

use Illuminate\Http\JsonResponse;
use Modules\Sanctum\Enums\TokenType;
use Modules\Sanctum\Exceptions\TokenExceptions;

trait HasSanctumExceptions
{
    /**
     * Handle Cognito Exception
     *
     * @param string $tokenType
     * @return JsonResponse
     * @throws TokenExceptions
     */
    public function handleSanctumExceptions(string $tokenType): JsonResponse
    {
        $message = __('sanctum::auth.token_expired');
        if (!empty($tokenType) && $tokenType === TokenType::Access->value) {
            $message = __('sanctum::auth.refresh_expired');
        }

        //@phpstan-ignore-next-line
        throw new TokenExceptions($message);
    }
}
