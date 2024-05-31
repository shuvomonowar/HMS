<?php

namespace App\Http\Controllers\Users\Receptionist;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\Receptionist\LoginRequest;
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
        return redirect()->route('receptionist_user.login');
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

        if (Auth::guard('employee_record')->attempt($credentials)) {
            // Set username in session
            Session::put('username', $request->username);

            return redirect()->route('receptionist_user.dashboard', ['username' => $request->username]);
        }

        return redirect()->back()->withInput($request->only('username', 'password'))->withErrors([
            'password' => 'The provided password is incorrect.'
        ]);
    }
}
