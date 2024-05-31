<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsReceptionistUser
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('employee_record')->check() && Auth::guard('employee_record')->user()->department == 'Receptionist') {
            return $next($request);
        }

        return redirect()->route('receptionist_user.login');
    }
}
