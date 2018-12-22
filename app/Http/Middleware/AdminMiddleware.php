<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            //view()->share("current_user", $user);
            if ($user->quyen == 1) {
                return $next($request);
            } else {
                return redirect()->route('admin_login');
            }
        } else {
            return redirect()->route('admin_login');
        }
    }
}
