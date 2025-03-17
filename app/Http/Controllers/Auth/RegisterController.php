<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\VerifyEmailNotification;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Customer;
use App\Models\Address;
use App\Models\RegisteredCustomer;

class RegisterController extends Controller
{


    use RegistersUsers;


    protected $redirectTo = "/verify/email";

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
        $validator = Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        
        DB::beginTransaction();

        try {
            $user = User::create([
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'email_verified_at' => null,
            ]);
    
            $customer = Customer::where('email', $data['email'])->first();
            
            // SYNC USER ACCOUNT WITH CUSTOMER IF CUSTOMER DATA ALREADY EXIST
            if ($customer) {
                RegisteredCustomer::firstOrCreate([
                    'user_id' => $user->id,
                    'customer_id' => $customer->id,
                ]);
            } 
    
            DB::commit();
            return $user;
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['Something went wrong: ' . $e->getMessage()]);
        }

    }
}
