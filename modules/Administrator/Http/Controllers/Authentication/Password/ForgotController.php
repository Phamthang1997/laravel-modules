<?php

namespace Modules\Administrator\Http\Controllers\Authentication\Password;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Modules\Administrator\Email\Password\Complete;
use Modules\Administrator\Http\Controllers\AdministratorController;
use Modules\Administrator\Http\Requests\Authentication\Password\ForgotRequest;
use Modules\Administrator\Http\Requests\Authentication\Password\ResetRequest;
use Modules\Administrator\Http\Requests\Authentication\Password\TokenRequest;
use Modules\Administrator\Services\Contracts\PasswordServiceInterface;

class ForgotController extends AdministratorController
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
     * @return mixed
     */
    public function show(): mixed
    {
        return view('administrator::authentication.password.forgot');
    }

    /**
     * @param ForgotRequest $request
     * @return mixed
     */
    public function send(ForgotRequest $request): mixed
    {
        $status = $this->passwordService->send($request);

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]); /** @phpstan-ignore-line */
    }

    /**
     * @param TokenRequest $request
     * @return mixed
     */
    public function token(TokenRequest $request): mixed
    {
        return view('administrator::authentication.password.change', ['token' => $request->token, 'email' => $request->email]);
    }

    /**
     * @param ResetRequest $request
     * @return mixed
     */
    public function reset(ResetRequest $request): mixed
    {
        $status = $this->passwordService->reset($request);

        if ($status === Password::PASSWORD_RESET) {
            // Change password complete...
            Mail::to($request->email)->send(new Complete());

            return redirect()->route('management.password.complete'); /** @phpstan-ignore-line */
        }

        return back()->withErrors(['email' => [__($status)]]); /** @phpstan-ignore-line */
    }

    /**
     * @return mixed
     */
    public function complete(): mixed
    {
        return view('administrator::authentication.password.complete');
    }
}
