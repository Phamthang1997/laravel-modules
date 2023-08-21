<?php

namespace Modules\Administrator\Services;

use Modules\Administrator\Repositories\Contracts\UserRepositoryInterface;
use Modules\Administrator\Services\Contracts\UserServiceInterface;

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
}
