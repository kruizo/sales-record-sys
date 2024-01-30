<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    public function showProfile()
    {
        return view('profiles.setup');
    }

    public function userOrders()
    {
        return view('profiles.order');
    }
    public function verifyUser(Request $req)
    {
        $req->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        $user = User::where('email', $req->email)->first();

        if ($user) {
            $user->sendEmailVerificationNotification();

            return redirect()->back()->with('success', 'Verification link sent successfully!');
        }

        return redirect()->back()->with('error', 'User not found with the provided email.');
    }
}
