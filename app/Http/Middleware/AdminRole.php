<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {


        if (Auth::check() && Auth::user()->role == 'admin') {
            return $next($request);
        } else if (Auth::check() && Auth::user()->role == 'merchant') {
            return redirect()->route('merchant');
        } else if (Auth::check() && Auth::user()->role == 'agent') {
            return redirect()->route('agent');
        } else if (Auth::check() && Auth::user()->role == 'user') {
            return redirect()->route('/');
        } else {
            return redirect()->route('/');
        }
    }
}