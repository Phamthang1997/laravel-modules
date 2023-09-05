<?php

namespace Modules\Mobile\Repositories;

use Modules\Mobile\Models\User;
use App\Repositories\BaseRepository;
use Modules\Sanctum\Models\PersonalAccessToken;
use Modules\Mobile\Repositories\Contracts\UserRepositoryInterface;

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

    /**
     * @param string $refreshToken
     * @return mixed
     */
    public function getToken(string $refreshToken): mixed
    {
        $modelToken = PersonalAccessToken::findToken($refreshToken);
        // check exits Refresh Token and valid
        if (!$modelToken || !$modelToken->isValid()) {
            return false;
        }

        return PersonalAccessToken::findOrFail($modelToken->access_id);
    }
}
