<?php

namespace App\Http\Controllers\Users\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\Doctor\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /**
     * Show the system admin login form.
     *
     * @return RedirectResponse
     */
    public function showLoginForm(): RedirectResponse
    {
        return redirect()->route('doctor_user.login');
    }

    /**
     * Handle the system admin login request.
     *
     * @param LoginRequest $request
     * @return RedirectResponse
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->only('username', 'password');

        if (Auth::guard('doctor_record')->attempt($credentials)) {
            // Set username in session
            Session::put('username', $request->username);

            return redirect()->route('doctor_user.dashboard', ['username' => $request->username]);
        }

        return redirect()->back()->withInput($request->only('username', 'password'))->withErrors([
            'password' => 'The provided password is incorrect.'
        ]);
    }
}
