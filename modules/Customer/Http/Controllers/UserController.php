<?php

namespace Modules\Customer\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Modules\Customer\Http\Requests\Customer\CreateRequest;
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

    /**
     * @return mixed
     */
    public function home(): mixed
    {
        return view('customer::page.home');
    }

    /**
     * @return mixed
     */
    public function create(): mixed
    {
        return view('customer::page.customer.create');
    }

    /**
     * @param CreateRequest $request
     * @return mixed
     */
    public function store(CreateRequest $request): mixed
    {
        $this->userService->create($request->name, $request->email, $request->password);

        return view('customer::authentication.login');
    }

    /**
     * @return mixed
     */
    public function login(): mixed
    {
        return view('customer::authentication.login');
    }
}
