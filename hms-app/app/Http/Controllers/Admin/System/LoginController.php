<?php

namespace App\Http\Controllers\Admin\System;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\System\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    /**
     * Show the system admin login form.
     *
     * @return View
     */
    public function showLoginForm(): View
    {
        return view('admin.system.login');
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

        if (Auth::guard('system_admin')->attempt($credentials)) {
            return redirect()->route('system_admin.dashboard');
        }

        return redirect()->back()->withInput($request->only('username', 'password'))->withErrors([
            'password' => 'The provided password is incorrect'
        ]);
    }
}
