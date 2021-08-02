<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            return redirect(RouteServiceProvider::HOME);
        }

        // if (Auth::check() && Auth::user()->role == 'merchant') {
        //     return $next($request);
        // } else if (Auth::check() && Auth::user()->role == 'agent') {
        //     return redirect()->route('agent');
        // } else if (Auth::check() && Auth::user()->role == 'admin') {
        //     return redirect()->route('admin');
        // } else if (Auth::check() && Auth::user()->role == 'user') {
        //     return redirect()->route('/');
        // } else {
        //     return redirect()->route('login');
        // }


        return $next($request);
    }
}