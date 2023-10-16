<?php

namespace Modules\Customer\Http\Controllers\Authentication\Password;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Modules\Customer\Email\Password\Complete;
use Modules\Customer\Http\Controllers\CustomerController;
use Modules\Customer\Http\Requests\Authentication\Password\ForgotRequest;
use Modules\Customer\Http\Requests\Authentication\Password\ResetRequest;
use Modules\Customer\Http\Requests\Authentication\Password\TokenRequest;
use Modules\Customer\Services\Contracts\PasswordServiceInterface;

class ForgotController extends CustomerController
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
        return view('customer::authentication.password.forgot');
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
        return view('customer::authentication.password.change', ['token' => $request->token, 'email' => $request->email]);
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

            return redirect()->route('customer.password.complete'); /** @phpstan-ignore-line */
        }

        return back()->withErrors(['email' => [__($status)]]); /** @phpstan-ignore-line */
    }

    /**
     * @return mixed
     */
    public function complete(): mixed
    {
        return view('customer::authentication.password.complete');
    }
}
