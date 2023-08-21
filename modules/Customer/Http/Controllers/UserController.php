<?php

namespace Modules\Customer\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Modules\Customer\Services\Contracts\UserServiceInterface;

class UserController extends CustomerController
{
    private UserServiceInterface $userService;

    /**
     * Construct container
     *
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
    public function show(): mixed
    {
        return $this->userService->show(1);
    }

    public function home(): mixed
    {
        $user = Auth::user();

        return view('customer::page.home', compact('user'));
    }

    /**
     * @return mixed
     */
    public function login(): mixed
    {
        return view('customer::authentication.login');
    }
}
