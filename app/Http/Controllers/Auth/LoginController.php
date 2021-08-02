<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('redirectlogin')->except('logout');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    public function redirectTo()
    {
        if (Auth::check() && Auth::user()->role == 'user') {
            return ('/');
        } else if (Auth::check() && Auth::user()->role == 'agent') {
            return ('/agent');
        } else if (Auth::check() && Auth::user()->role == 'admin') {
            return ('/admin');
        } else if (Auth::check() && Auth::user()->role == 'merchant') {
            return ('/merchant');
        } else {
            return ('/');
        }
    }
}