<?php

namespace Modules\Administrator\Http\Controllers\Authentication;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Administrator\Http\Controllers\AdministratorController;
use Modules\Administrator\Http\Requests\Authentication\LoginRequest;

class LoginController extends AdministratorController
{

    /**
     * @return mixed
     */
    public function login(): mixed
    {
        return view('administrator::authentication.login');
    }

    /**
     * Handle an authentication attempt.
     *
     * @param LoginRequest $request
     * @return RedirectResponse
     */
    public function authenticate(LoginRequest $request): RedirectResponse
    {
        $credentials = (array) $request->validated();

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            //@phpstan-ignore-next-line
            return redirect()->route($request->route()->getPrefix().'.home');
        }

        return back()->withErrors([
            'warning' => __('administrator::auth.failed'),
        ])->onlyInput('email');
    }

    /**
     * Log the user out of the application.
     *
     * @param Request $request
     * @return mixed
     */
    public function logout(Request $request): mixed
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return view('administrator::authentication.logout');
    }
}
