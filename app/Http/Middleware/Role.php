<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (Auth::check()) {
            if (Auth::user()->role_id == $role || Auth::user()->role_id == config('role.admin.management')) {
                return $next($request);
            }

            return redirect()->back();
        }

        return redirect()->route('user.getLogin');
    }
}
