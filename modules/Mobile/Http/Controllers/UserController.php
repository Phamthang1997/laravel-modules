<?php

namespace Modules\Mobile\Http\Controllers;

use Modules\Mobile\Services\Contracts\UserServiceInterface;

class UserController extends MobileController
{
    /**
     *
     * @param UserServiceInterface $userService;
     */
    private UserServiceInterface $userService;

    /**
     * __construct
     *
     * @param UserServiceInterface $userService;
     */
    public function __construct(
        UserServiceInterface $userService,
    )
    {
        $this->userService = $userService;
    }

    /**
     * @return mixed
     */
    public function profile(): mixed
    {
        $result = $this->userService->profile();

        return $this->successResponse($result);
    }
}
