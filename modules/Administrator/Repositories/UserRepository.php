<?php

namespace Modules\Administrator\Repositories;

use App\Repositories\BaseRepository;
use Modules\Administrator\Models\User;
use Modules\Administrator\Repositories\Contracts\UserRepositoryInterface;

/**
 * @property User $model
 */
class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function model(): string
    {
        return User::class;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getDetail(int $id): mixed
    {
        return $this->model->where('id', $id)->first();
    }
}
