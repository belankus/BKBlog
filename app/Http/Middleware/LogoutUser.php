<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LogoutUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (!empty($user->activity->is_logged_out) && $user->activity->is_logged_out == 1) {
            Auth::logout();

            return redirect('/login')->with('loginAgain', 'Password changed, please login again');
        }
        return $next($request);
    }
}
