<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Customer;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = 'verified/setup';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    public function setupProfile()
    {
        $user = User::find(Auth::user()->id);
        if (!$user) {
            abort(404);
        }

        $hasProfile = Customer::where('user_id', $user->id)->exists();

        if ($hasProfile) {
            return redirect()->route('verification');
        }

        return view('auth.profile-form', compact('user'));
    }
    protected function redirectTo()
    {
        return route('verified.setup');
    }
}
