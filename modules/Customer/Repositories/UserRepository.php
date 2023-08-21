<?php

namespace Modules\Customer\Repositories;

use App\Repositories\BaseRepository;
use Modules\Customer\Models\User;
use Modules\Customer\Repositories\Contracts\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function model()
    {
        return User::class;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getDetail(int $id): mixed
    {
        return $this->model()::whereId($id)->first();
    }
}
