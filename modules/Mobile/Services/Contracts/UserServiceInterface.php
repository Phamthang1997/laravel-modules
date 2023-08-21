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
     * @return mixed
     */
    public function profile(): mixed;
}
