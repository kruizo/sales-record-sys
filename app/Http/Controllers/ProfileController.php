<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use App\Models\Address;
use App\Models\Order;
use App\Models\Orderline;
use App\Models\Delivery;
use App\Models\DeliveryStatus;
use App\Models\RegisteredCustomer;

class ProfileController extends Controller
{
    public function index()
    {
        list($customer, $address) = $this->getCustomerAndAddress();
        $isAdmin = auth()->user()->isAdmin;
        return view('profiles.setup', compact('customer', 'address'));
    }

    public function orders(Request $request)
    {
      list($customer, $address) = $this->getCustomerAndAddress();
      $orders = Order::find($customer->id)->latest()->with('orderline.delivery', 'orderline')->get();

      if ($status = request('status')) {
            $orders = Order::latest()->with('orderline.delivery', 'orderline')->get();
            $status = trim(str_replace(' ', '', $status));
            $orders = $orders->filter(function ($order) use ($status) {
                return $order->orderline->contains(function ($orderline) use ($status) {
                    $actualStatus = $orderline->delivery->deliverystatus->status;
                    $actualStatus = trim(str_replace(' ', '', $actualStatus));

                    return strcasecmp($actualStatus, $status) === 0;
                });
            });
        }

//         $recentOrder = $orders->first();
// $recentOrderline = $recentOrder->orderline->first();
// $deliveryorder = $recentOrderline->delivery->delivery_date;
//  dd($recentOrder, $recentOrderline, $deliveryorder);

        $recent = $orders->first()->orderline->first();
        return view('profiles.order', compact('customer', 'address', 'orders', 'recent'));
    }




    private function getCustomerAndAddress()
    {
        $user = auth()->user();
        $registeredCustomer = RegisteredCustomer::where('user_id', $user->id)->first();
        $address = $registeredCustomer ? $registeredCustomer->customer->address : null;

        return [$registeredCustomer->customer ?? null, $address];
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

         list($customer, $address) = $this->getCustomerAndAddress();

         $addressData = [
            'streetaddress' => $request->input('street_address_edit'),
            'province' => $request->input('province_edit'),
            'barangay' => $request->input('barangay_edit'),
            'city' => $request->input('city_edit'),
            'zip' => $request->input('zip_edit'),
        ];
        
        $address = $address ? $address->update($addressData) : Address::create($addressData);

        
        $customerData = [
            'firstname' => $request->input('firstname_edit'),
            'lastname' => $request->input('lastname_edit'),
            'contactnum' => $request->input('contact_edit'),
            'email' => Auth::user()->email,
            'address_id' => $address->id,
        ];

        $user = Auth::user();

        $customer = $customer ?  $customer->update($customerData) : Customer::create($customerData);
      
        $registeredCustomer = RegisteredCustomer::create([
            'customer_id' => $customer->id,
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->route('profile')->with('success', 'Profile updated successfully');
    }
}
