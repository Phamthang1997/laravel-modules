<?php

namespace Modules\Mobile\Http\Controllers\Authentication;

use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Modules\Mobile\Http\Controllers\MobileController;
use Modules\Mobile\Http\Requests\AuthenticateRequest;
use Modules\Mobile\Http\Requests\RefreshTokenRequest;
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
     */
    public function authenticate(AuthenticateRequest $request): JsonResponse
    {
        /** @phpstan-ignore-next-line */
        $result = $this->userService->login($request->email, $request->password);

        return $this->successResponse($result);
    }

    /**
     * Handle an authentication attempt.
     * @param RefreshTokenRequest $request
     * @return JsonResponse
     */
    public function refreshToken(RefreshTokenRequest $request): JsonResponse
    {
        /** @phpstan-ignore-next-line */
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
