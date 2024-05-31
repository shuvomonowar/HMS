<?php

namespace App\Http\Controllers\Users\Receptionist;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display all patient appointment records.
     *
     * @return Application|Factory|\Illuminate\Foundation\Application|View
     */
    public function dashboard(Request $request): View|\Illuminate\Foundation\Application|Factory|Application
    {
        // Retrieve the username from the request
        $username = $request->username;

        return view('users.receptionist.dashboard', compact('username'));
    }
}
