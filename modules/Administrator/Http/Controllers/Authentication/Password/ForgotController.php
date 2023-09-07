<?php

namespace Modules\Administrator\Http\Controllers\Authentication\Password;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Modules\Administrator\Email\Password\Complete;
use Modules\Administrator\Http\Controllers\AdministratorController;
use Modules\Administrator\Http\Requests\Authentication\Password\ForgotRequest;
use Modules\Administrator\Http\Requests\Authentication\Password\ResetRequest;
use Modules\Administrator\Http\Requests\Authentication\Password\TokenRequest;
use Modules\Administrator\Models\User;

class ForgotController extends AdministratorController
{

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
        $status = Password::broker('administrator')->sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
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
        $status = Password::broker('administrator')->reset(
            $request->only('email', 'password', 'confirm_password', 'token'),
            function (User $user, string $password) {
                $user->forceFill(['password' => Hash::make($password)])->setRememberToken(Str::random(60));
                $user->save();

                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            // Change password complete...
            Mail::to($request->email)->send(new Complete());
            //@phpstan-ignore-next-line
            return redirect()->route('management.password.complete');
        }

        //@phpstan-ignore-next-line
        return back()->withErrors(['email' => [__($status)]]);
    }

    /**
     * @return mixed
     */
    public function complete(): mixed
    {
        return view('administrator::authentication.password.complete');
    }
}
