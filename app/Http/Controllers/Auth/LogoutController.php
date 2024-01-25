<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LogoutController extends Controller
{
    protected $redirectTo = '/login';

    use AuthenticatesUsers;

    public function logout(Request $request)
    {
        $this->logout($request);
        return redirect()->route('your_route');
    }
}
