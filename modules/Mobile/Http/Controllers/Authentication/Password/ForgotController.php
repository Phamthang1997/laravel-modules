<?php

namespace Modules\Mobile\Http\Controllers\Authentication\Password;

use Illuminate\Support\Facades\Password;
use Modules\Mobile\Http\Controllers\MobileController;
use Modules\Mobile\Http\Requests\Authentication\Password\ForgotRequest;
use Modules\Mobile\Http\Requests\Authentication\Password\ResetRequest;
use Modules\Mobile\Http\Requests\Authentication\Password\VerifyRequest;
use Modules\Mobile\Services\Contracts\PasswordServiceInterface;

class ForgotController extends MobileController
{
    private PasswordServiceInterface $passwordService;

    /**
     * Construct container
     *
     */
    public function __construct(
        PasswordServiceInterface $passwordService,
    )
    {
        $this->passwordService = $passwordService;
    }

    /**
     * @param ForgotRequest $request
     * @return mixed
     */
    public function forgot(ForgotRequest $request): mixed
    {
        $result = $this->passwordService->forgot($request);

        return ($result === Password::INVALID_USER || $result === Password::RESET_THROTTLED)
            ? $this->badRequestErrorResponse(null, __($result))
            : $this->successResponse(['token' => intval($result)]); /** @phpstan-ignore-line */
    }

    /**
     * @param VerifyRequest $request
     * @return mixed
     * @throws \ReflectionException
     */
    public function verify(VerifyRequest $request): mixed
    {
        $result = $this->passwordService->verify($request->token);

        return $result === Password::INVALID_TOKEN
            ? $this->badRequestErrorResponse(null, __($result))
            : $this->successResponse(__($result));
    }

    /**
     * @param ResetRequest $request
     * @return mixed
     * @throws \ReflectionException
     */
    public function reset(ResetRequest $request): mixed
    {
        $result = $this->passwordService->reset($request->token, $request->password);

        return ($result === Password::INVALID_USER || $result === Password::INVALID_TOKEN)
            ? $this->badRequestErrorResponse(null, __($result))
            : $this->successResponse(__($result));
    }
}
