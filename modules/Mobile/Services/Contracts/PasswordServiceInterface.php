<?php

namespace Modules\Mobile\Services\Contracts;

use Illuminate\Http\Request;

interface PasswordServiceInterface
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function forgot(Request $request): mixed;

    /**
     * @param string $token
     * @return string
     * @throws \ReflectionException
     */
    public function verify(string $token): string;

    /**
     * @param string $token
     * @param string $password
     * @return string
     * @throws \ReflectionException
     */
    public function reset(string $token, string $password): string;
}
