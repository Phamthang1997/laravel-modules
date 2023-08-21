<?php

namespace Modules\Customer\Http\Controllers\Authentication;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Modules\Customer\Http\Controllers\CustomerController;
use Modules\Customer\Http\Requests\AuthenticateRequest;
use Illuminate\Http\Request;

class LoginController extends CustomerController
{
    /**
     * Handle an authentication attempt.
     */
    public function authenticate(AuthenticateRequest $request): RedirectResponse
    {
        $credentials = (array) $request->validated();

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            /** @phpstan-ignore-next-line */
            return redirect()->route($request->route()->getPrefix().'.home');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
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
        return redirect()->route($request->route()->getPrefix().'.login');
    }
}
