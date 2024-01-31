<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Customer;
use App\Models\Address;

class RegisterController extends Controller
{


    use RegistersUsers;


    protected $redirectTo = "verification";

    public function __construct()
    {
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'email_verified_at' => null,
        ]);
    }


    public function profileRegistration(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'contact_number' => ['required', 'string', 'max:20'],
            'street_address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'province' => ['required', 'string', 'max:255'],
            'zip' => ['required', 'string', 'max:10'],
            'barangay' => ['required', 'string', 'max:255'],
        ]);

        $address = Address::create([
            'streetaddress' => $request->street_address,
            'province' => $request->province,
            'city' => $request->city,
            'zip' => $request->zip,
            'barangay' => $request->barangay,
        ]);

        $customer = Customer::create([
            'address_id' => $address->id,
            'user_id' => Auth::id(),
            'firstname' => $request->first_name,
            'lastname' => $request->last_name,
            'contactnum' => $request->contact_number,
            'email' => Auth::user()->email,
        ]);

        return redirect()->route('/home');
    }
}
