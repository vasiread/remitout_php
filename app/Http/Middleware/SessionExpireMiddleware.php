<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SessionExpireMiddleware
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
        if (session('expires_at') && now()->greaterThan(session('expires_at'))) {
            session()->flush();
            session()->flash('session_expired', 'Your session has expired. Please log in again.');


            return redirect()->route('login'); 
        }
        return $next($request);
    }
}
