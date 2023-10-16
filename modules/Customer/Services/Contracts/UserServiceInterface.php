<?php

namespace Modules\Customer\Services\Contracts;

interface UserServiceInterface
{
    /**
     * @param int $id
     * @return mixed
     */
    public function show(int $id): mixed;

    /**
     * @param string $name
     * @param string $email
     * @param string $password
     * @return mixed
     */
    public function create(string $name, string $email, string $password): mixed;
}
