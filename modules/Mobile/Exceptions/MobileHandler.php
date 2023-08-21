<?php

namespace Modules\Mobile\Exceptions;

use App\Exceptions\Handler;
use Illuminate\Auth\AuthenticationException;

class MobileHandler extends Handler
{
    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->renderable(function (AuthenticationException $e) {
            throw new BaseException($e);
        });
    }
}
