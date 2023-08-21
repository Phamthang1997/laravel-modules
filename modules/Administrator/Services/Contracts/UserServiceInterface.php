<?php

namespace Modules\Administrator\Services\Contracts;

interface UserServiceInterface
{
    /**
     * @param int $id
     * @return mixed
     */
    public function show(int $id): mixed;
}
