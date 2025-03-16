<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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

    /**
     *
     * @return void
     */
    protected function redirectTo()
    {
        if (auth()->user()->is_admin) {
            return '/admin'; 
        }
        return '/'; 
    }
    
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        
    }

    protected function loggedOut(Request $request)
    {
        return redirect('/login');
    }
}