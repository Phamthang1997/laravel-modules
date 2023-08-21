<?php

namespace Modules\Administrator\Repositories\Contracts;

use App\Repositories\Contracts\BaseRepositoryInterface;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @param int $id
     * @return mixed
     */
    public function getDetail(int $id): mixed;
}
