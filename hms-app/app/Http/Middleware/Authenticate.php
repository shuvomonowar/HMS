<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
   /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        /*if (!$request->expectsJson()) {
            if ($request->user() && $request->user()->isSystemAdmin()) {
                return route('system_admin.login');
            }
            elseif ($request->user() && $request->user()->isReceptionistUser()) {
                return route('receptionist_user.login');
            }

            return route('system_admin.login');
        }

        return null;*/
        return $request->expectsJson() ? null : route('homepage');
    }
}
