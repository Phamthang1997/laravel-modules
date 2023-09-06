<?php

namespace Modules\Sanctum\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use App\Traits\JsonResponse\MobileResponse;

final class TokenExceptions extends Exception
{
    use MobileResponse;

    /**
     * Construct Token Exceptions
     *
     * @param string $message
     */
    // phpcs:ignore
    public function __construct(string $message)
    {
        parent::__construct($message);
    }

    /**
     * Render Error Response
     *
     * @return JsonResponse
     */
    public function render(): JsonResponse
    {
        return $this->unAuthorizedErrorResponse($this->code, $this->message);
    }
}
