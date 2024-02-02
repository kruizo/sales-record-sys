<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use App\Models\Address;
use App\Models\Order;
use App\Models\Orderline;

class ProfileController extends Controller
{
    public function showProfile()
    {
        list($customer, $address) = $this->getCustomerAndAddress();
        $isAdmin = auth()->user()->isAdmin;

        return view('profiles.setup', compact('customer', 'address'));
    }

    public function userOrders()
    {
        list($customer, $address) = $this->getCustomerAndAddress();
        $user = auth()->user();
        $customer = Customer::where('user_id', $user->id)->first();
        $address = $customer ? $customer->address : null;
        // Use optional() to handle cases where $customer is null
        $orders = optional($customer)->orders()->with('orderline', 'delivery')->orderBy('created_at', 'desc')->get();
        $recent = $orders->first();

        return view('profiles.order', compact('customer', 'address', 'orders', 'recent'));
    }

    private function getCustomerAndAddress()
    {
        $user = auth()->user();
        $customer = Customer::where('user_id', $user->id)->first();
        $address = $customer ? $customer->address : null;

        return [$customer, $address];
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
    public function saveProfile(Request $request)
    {
        $request->validate([
            'firstname_edit' => 'required',
            'lastname_edit' => 'required',
            'contact_edit' => 'required|numeric',
            'street_address_edit' => 'required',
            'province_edit' => 'required',
            'barangay_edit' => 'required',
            'city_edit' => 'required',
            'zip_edit' => 'required|numeric',
        ]);

        $address = Address::updateOrCreate(
            [
                'streetaddress' => $request->input('street_address_edit'),
                'province' => $request->input('province_edit'),
                'barangay' => $request->input('barangay_edit'),
                'city' => $request->input('city_edit'),
                'zip' => $request->input('zip_edit'),
            ]
        );

        $user = Auth::user();
        if ($user->customer) {
            $user->customer->update([
                'firstname' => $request->input('firstname_edit'),
                'lastname' => $request->input('lastname_edit'),
                'contactnum' => $request->input('contact_edit'),
                'email' => $user->email,
                'address_id' => $address->id,
            ]);
        } else {
            Customer::create([
                'firstname' => $request->input('firstname_edit'),
                'lastname' => $request->input('lastname_edit'),
                'contactnum' => $request->input('contact_edit'),
                'email' => $user->email,
                'address_id' => $address->id,
                'user_id' => $user->id,
            ]);
        }

        return redirect()->route('profile')->with('success', 'Profile updated successfully');
    }
}
