<?php

namespace Modules\Mobile\Repositories\Contracts;

use App\Repositories\Contracts\BaseRepositoryInterface;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @param int $id
     * @return mixed
     */
    public function getDetail(int $id): mixed;

    /**
     * @param string $refreshToken
     * @return mixed
     */
    public function getToken(string $refreshToken): mixed;
}
