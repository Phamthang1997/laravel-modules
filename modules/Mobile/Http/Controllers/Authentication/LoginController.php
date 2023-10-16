<?php

namespace Modules\Mobile\Http\Controllers\Authentication;

use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Modules\Mobile\Exceptions\BaseException;
use Modules\Mobile\Http\Controllers\MobileController;
use Modules\Mobile\Http\Requests\Customer\RefreshTokenRequest;
use Modules\Mobile\Http\Requests\LoginRequest;
use Modules\Mobile\Services\Contracts\UserServiceInterface;

class LoginController extends MobileController
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
     * @return void
     */
    public function __construct(
        UserServiceInterface $userService,
    )
    {
        $this->userService = $userService;
    }

    /**
     * Handle an authentication attempt.
     * @throws BaseException
     */
    public function authenticate(LoginRequest $request): JsonResponse
    {
        $result = $this->userService->login($request->email, $request->password);

        return $this->successResponse($result);
    }

    /**
     * Handle an refresh token authentication attempt.
     */
    public function refreshToken(RefreshTokenRequest $request): JsonResponse
    {
        $result = $this->userService->refreshToken($request->refresh_token);

        return $this->successResponse($result);
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request): ResponseFactory|Application|Response|JsonResponse
    {
        /** @phpstan-ignore-next-line */
        $request->user()->currentAccessToken()->delete();

        return $this->successResponse();
    }
}
