<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('admin_user_id') || session('admin_role') !== 'superadmin') {
            return redirect('/login');
        }

        // Optional: Check if the session has expired
        if (session()->has('expires_at') && now()->greaterThan(session('expires_at'))) {
            session()->flush(); // Expire the session
            return redirect('/login');
        }

        return $next($request);
    }
}
