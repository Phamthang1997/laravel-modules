<?php

namespace Modules\Administrator\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Modules\Administrator\Services\Contracts\UserServiceInterface;

class UserController extends AdministratorController
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

        return view('administrator::page.home', compact('user'));
    }
}
