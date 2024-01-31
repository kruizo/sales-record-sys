<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Customer;

class ProfileController extends Controller
{
    public function showProfile()
    {
        $user = auth()->user();
        $customer = Customer::where('user_id', $user->id)->first();
        $address = $customer ? $customer->address : null;

        return view('profiles.setup', compact('customer', 'address'));
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

        $user->sendEmailVerificationNotification();

        return redirect()->route('verification', ['token' => $user->verification_token]);
    }
}
