<?php

namespace Modules\Mobile\Repositories;

use Modules\Mobile\Models\User;
use App\Repositories\BaseRepository;
use Modules\Sanctum\Models\PersonalAccessToken;
use Modules\Mobile\Repositories\Contracts\UserRepositoryInterface;

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

    /**
     * @param string $refreshToken
     * @return mixed
     */
    public function getToken(string $refreshToken): mixed
    {
        $refreshToken = PersonalAccessToken::findToken($refreshToken);
        // check exits Refresh Token and valid
        if (!$refreshToken || !$refreshToken->isValid()) {
            return false;
        }

        return PersonalAccessToken::findOrFail($refreshToken->access_id); // @phpstan-ignore-line
    }
}
