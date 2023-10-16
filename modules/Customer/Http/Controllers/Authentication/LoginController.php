<?php

namespace Modules\Customer\Http\Controllers\Authentication;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Customer\Http\Controllers\CustomerController;
use Modules\Customer\Http\Requests\Authentication\LoginRequest;

class LoginController extends CustomerController
{
    /**
     * Handle an authentication attempt.
     */
    public function authenticate(LoginRequest $request): RedirectResponse
    {
        $credentials = (array) $request->validated();

        if (Auth::attempt($credentials, !empty($request->remember))) {
            $request->session()->regenerate();

            /** @phpstan-ignore-next-line */
            return redirect()->route('customer.home');
        }

        return back()->withErrors([
            'warning' => __('customer::auth.failed'),
        ])->onlyInput('email');
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        /** @phpstan-ignore-next-line */
        return redirect()->route('customer.index');
    }
}
