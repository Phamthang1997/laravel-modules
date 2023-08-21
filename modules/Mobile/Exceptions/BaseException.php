<?php

namespace Modules\Mobile\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use App\Traits\JsonResponse\MobileResponse;

class BaseException extends Exception
{
    use MobileResponse;
    private Exception $exception;
    /**
     * Construct Exception
     *
     * @param Exception $exception
     */
    public function __construct(Exception $exception)
    {
        $this->exception = $exception;
        parent::__construct($exception->message, (int) $exception->code, $exception->getPrevious());
    }

    /**
     * Render Error Response
     *
     * @return JsonResponse
     */
    public function render(): JsonResponse
    {
        return match (true) {
            $this->exception instanceof AuthenticationException => $this->unAuthorizedErrorResponse($this->code, $this->message),
            default => $this->badRequestErrorResponse($this->code, $this->message),
        };
    }
}
