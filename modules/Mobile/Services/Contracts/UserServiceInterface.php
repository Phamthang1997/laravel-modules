<?php

namespace Modules\Mobile\Services\Contracts;

use Modules\Mobile\Exceptions\BaseException;

interface UserServiceInterface
{
    /**
     * @param string $email
     * @param string $password
     * @return mixed
     * @throws BaseException
     */
    public function login(string $email, string $password): mixed;

    /**
     * @param string $refreshToken
     * @return array<string, float|int|string>
     * @throws \Throwable
     */
    public function refreshToken(string $refreshToken): array;

    /**
     * @return mixed
     */
    public function profile(): mixed;
}
