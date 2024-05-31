<?php

namespace App\Http\Controllers\Users\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout(): RedirectResponse
    {
        Auth::guard('doctor_record')->logout();

        return redirect()->route('doctor_user.login');
    }
}
