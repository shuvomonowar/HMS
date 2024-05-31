<?php

namespace App\Http\Controllers\Users\Receptionist;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout(): RedirectResponse
    {
        Auth::guard('employee_record')->logout();

        return redirect()->route('receptionist_user.login');
    }
}
