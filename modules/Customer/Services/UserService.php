<?php

namespace Modules\Customer\Services;

use Modules\Customer\Repositories\Contracts\UserRepositoryInterface;
use Modules\Customer\Services\Contracts\UserServiceInterface;

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
     * @param int $id
     * @return mixed
     */
    public function show(int $id): mixed
    {
        return $this->userRepository->getDetail($id);
    }

    /**
     * @param string $name
     * @param string $email
     * @param string $password
     * @return mixed
     */
    public function create(string $name, string $email, string $password): mixed
    {
        return $this->userRepository->create(['name' => $name, 'email' => $email, 'password' => $password]);
    }
}
