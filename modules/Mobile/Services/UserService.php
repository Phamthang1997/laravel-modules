<?php

namespace Modules\Mobile\Services;

use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Hash;
use Modules\Mobile\Exceptions\BaseException;
use Modules\Mobile\Repositories\Contracts\UserRepositoryInterface;
use Modules\Mobile\Services\Contracts\UserServiceInterface;
use Modules\Sanctum\Models\PersonalAccessToken;

class UserService implements UserServiceInterface
{
    private UserRepositoryInterface $userRepository;

    /**
     * Construct Repository
     *
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
    )
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param string $email
     * @param string $password
     * @return mixed
     * @throws BaseException
     */
    public function login(string $email, string $password): mixed
    {
        /** @phpstan-ignore-next-line */
        $user = $this->userRepository->where('email', $email)->first();
        if (! $user || ! Hash::check($password, $user->password)) {
            throw new BaseException(new AuthenticationException());
        }
        $tokens = $user->createPersonalToken($email);
        //make response token users
        $user['token'] = $tokens['accessToken'];
        $user['token_expires'] = $tokens['expiresAt'];
        $user['refresh_token'] = $tokens['refreshToken'];

        return $user;
    }

    /**
     * @param string $refreshToken
     * @return array<string, float|int|string>
     * @throws \Throwable
     */
    public function refreshToken(string $refreshToken): array
    {
        $accessToken = $this->userRepository->getToken($refreshToken);
        /** @var PersonalAccessToken $accessToken*/
        $tokens = $accessToken->updatePersonalToken();
        $user['token'] = $tokens['accessToken'];
        $user['token_expires'] = $tokens['expiresAt'];
        $user['refresh_token'] = $refreshToken;

        return $user;
    }

    /**
     * @return mixed
     */
    public function profile(): mixed
    {
        return $this->userRepository->getDetail(auth()->user()->id); // @phpstan-ignore-line
    }
}
