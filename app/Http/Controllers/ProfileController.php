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
use App\Models\DeliveryFee;

class ProfileController extends Controller
{
    public function show()
    {
        $user = RegisteredCustomer::where('user_id', Auth::id())->first();
        if(!$user) {
            return redirect()->route('profile.setup');
        }
        
        $customer = $user->customer;

        return view('profile.index', compact('customer'));
    }

    public function showOrders(Request $request)
    {
        $user = Auth::user();

        if (Customer::where('email', $user->email)->doesntExist()) {
            return redirect()->route('profile.setup');
        }
        
        $customer = $user->registeredCustomer->customer;
        
        $statusId = DeliveryStatus::where('status', $request->status)->value('id') ?? DeliveryStatus::first()->id;
        
        $orders = $customer->orders()
        ->whereHas('delivery', fn($query) => $query->where('delivery_status', $statusId)) 
        ->with(['orderline.water'])
        ->latest()
        ->get();
    
        $fee = DeliveryFee::first()->fee;
        
        session(['filter_order_by' => DeliveryStatus::where('id', $statusId)->value('name')]);
        session()->save(); 

        return view('profile.order', compact('customer', 'orders',  'fee'));
    }

    public function setupProfile()
    {
        $registeredCustomer = RegisteredCustomer::where('user_id', Auth::id())->first();
        
        $customer = $registeredCustomer ? $registeredCustomer->customer : null; 

        if (!$customer) {
            return view('profile.setup', compact('customer'));

        }
        return redirect()->route('profile.show');
    }
}
