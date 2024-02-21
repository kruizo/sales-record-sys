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
        $customer = $this->AuthenticatedCustomer();
        return view('profiles.setup', compact('customer'));
    }

    public function orders(Request $request)
    {
      $customer = $this->AuthenticatedCustomer();
      $orders = $customer->orders()
        ->latest()
        ->whereHas('orderline', function ($query) {
            $query->where('is_archived', 0);
        })
        ->with('orderline.delivery.deliverystatus','orderline.water')
        ->get();



        if ($status = request('status')) {
            $status = trim(str_replace(' ', '', $status));
            $orders = $orders->filter(function ($order) use ($status) {
                $filteredOrderLines = $order->orderline->filter(function ($orderline) use ($status) {
                    $actualStatus = $orderline->delivery->deliverystatus->status;
                    $actualStatus = trim(str_replace(' ', '', $actualStatus));
                    return strcasecmp($actualStatus, $status) === 0;
                });

            $order->setRelation('orderline', $filteredOrderLines);

            return $filteredOrderLines->isNotEmpty();
            });
        } else{
            $orders = $orders->filter(function ($order){
            $filteredOrderLines = $order->orderline->filter(function ($orderline){
                $actualStatus = $orderline->delivery->delivery_status;
                return $actualStatus == 1;
            });

            $order->setRelation('orderline', $filteredOrderLines);

            return $filteredOrderLines->isNotEmpty();
            });
        }
       
        $recent = $orders->first();

        return view('profiles.order', compact('customer', 'orders', 'recent' , 'status'));
    }

    private function AuthenticatedCustomer()
    {
        return optional(RegisteredCustomer::where('user_id', auth()->id())->first())->customer;
    }

    public function verifyUser(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);
        $user = User::where('email', $request->email)->first();

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

         $customer = $this->AuthenticatedCustomer();

         $addressData = [
            'streetaddress' => $request->input('street_address_edit'),
            'province' => $request->input('province_edit'),
            'barangay' => $request->input('barangay_edit'),
            'city' => $request->input('city_edit'),
            'zip' => $request->input('zip_edit'),
        ];
        
        $address = Address::updateOrCreate(
                ['id' => $customer->address_id ?? ''], 
                $addressData                       
            );
        
        $customerData = [
            'firstname' => $request->input('firstname_edit'),
            'lastname' => $request->input('lastname_edit'),
            'contactnum' => $request->input('contact_edit'),
            'email' => Auth::user()->email,
            'address_id' => $address->id,
        ];
        $customer = Customer::updateOrCreate(
                ['id' => $customer->id ?? ''], 
                $customerData                       
        );

        $registeredCustomer = RegisteredCustomer::create([
            'customer_id' => $customer->id,
            'user_id' => User::find(auth()->id())->id,
        ]);

        return redirect()->route('profile')->with('success', 'Profile updated successfully');
    }
}
