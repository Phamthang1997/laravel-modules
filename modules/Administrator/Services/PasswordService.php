<?php

namespace Modules\Administrator\Services;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Modules\Administrator\Models\User;
use Illuminate\Http\Request;
use Modules\Administrator\Services\Contracts\PasswordServiceInterface;

class PasswordService implements PasswordServiceInterface
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function send(Request $request): mixed
    {
        return Password::broker('administrator')->sendResetLink(
            $request->only('email')
        );
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function reset(Request $request): mixed
    {
        return Password::broker('administrator')->reset(
            $request->only('email', 'password', 'confirm_password', 'token'),
            function (User $user, string $password) {
                $user->forceFill(['password' => Hash::make($password)])->setRememberToken(Str::random(60));
                $user->save();

                event(new PasswordReset($user));
            }
        );
    }
}
