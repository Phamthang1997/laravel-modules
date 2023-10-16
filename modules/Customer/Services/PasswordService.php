<?php

namespace Modules\Customer\Services;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Modules\Customer\Models\User;
use Modules\Customer\Services\Contracts\PasswordServiceInterface;

class PasswordService implements PasswordServiceInterface
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function send(Request $request): mixed
    {
        return Password::broker('customer')->sendResetLink(
            $request->only('email')
        );
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function reset(Request $request): mixed
    {
        return Password::broker('customer')->reset(
            $request->only('email', 'password', 'confirm_password', 'token'),
            function (User $user, string $password) {
                $user->forceFill(['password' => Hash::make($password)])->setRememberToken(Str::random(60));
                $user->save();

                event(new PasswordReset($user));
            }
        );
    }
}
