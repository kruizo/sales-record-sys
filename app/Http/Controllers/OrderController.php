<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Customer;
use App\Models\Water;
use App\Models\Orderline;
use App\Models\Delivery;
use App\Models\DeliveryEmployee;
use App\Models\Order;
use Illuminate\Support\Facades\Date;
use App\Models\Address;
use App\Models\RegisteredCustomer;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{


    public function index()
    {
        $user = auth()->user();
        $registeredcustomer = RegisteredCustomer::where('user_id', $user->id)->first();
        if (!$registeredcustomer) {
            return redirect()->route('verified.setup');
        }
        $customer = $registeredcustomer->customer;
        $address = $registeredcustomer ? $customer->address : null;
        //get water data
        $waters = Water::all();
        return view('/order', compact('customer', 'address', 'waters'));
    }

    public function placeOrder(Request $request)
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
            'payment_method' => ['required'],
            'total_order' => ['required', 'numeric'],
            'delivery_address' => ['required', 'string', 'max:255'],
            'expected_date' => ['not_before_today'],
            ], [
            'expected_date.not_before_today' => 'The :attribute must not be before today.',

        ]);

        $customerId = auth()->user()->registeredcustomer->customer->id;
        $paymentType = $request->input('payment_method');
        $mapReference = $request->input('mapreference');
        $deliveryDate = $request->input('expected_date');
        $deliveryTime = $request->input('expected_time');
        $specialInstructions = $request->input('special_instructions');
        $employeeId = DeliveryEmployee::where('isAvailable', 1)->first()->employee_id;
        $order = Order::create([
            'customer_id' => $customerId,
            'purchase_type' => 'Delivery',
            'payment_type' => $paymentType,
        ]);

        $deliveryAddress = $request->input('delivery_address');

       

        $totalOrders = 0;

        foreach ($request->input() as $key => $value) {
            if (is_numeric($value) && strpos($key, 'product_') !== false && $value > 0) {
                $waterId = substr($key, 8);
                $water = Water::find($waterId);

                $subtotal = $value * $water->cost;
                 
                $orderline = Orderline::create([
                    'order_id' => $order->id,
                    'water_id' => $water->id,
                    'quantity' => $value,
                    'subtotal' => $subtotal,
                ]);

                $delivery = Delivery::create([
                    'orderline_id' => $orderline->id,
                    'employee_id' => $employeeId,
                    'delivery_date' => $deliveryDate ?? Date::now()->toDateString(),
                    'delivery_time' => $deliveryTime ?? Date::now()->toTimeString(),
                    'delivery_address' => $deliveryAddress,
                    'map_reference' => $mapReference,
                    'special_instruction' => $specialInstructions,
                ]);

                $totalOrders++;
            }
        }


        return redirect()->route('profile/myorders');
    }

    public function cancelOrder($id){
        $orderline = Orderline::with('order.customer')->find($id);

        if (!$orderline) {
            abort(404, 'Orderline not found');
        }

        $authenticatedUserId = Auth::id();
        $orderCustomerId = $orderline->order->customer->registeredcustomer->user_id;


        if ($authenticatedUserId !== $orderCustomerId) {
            abort(403, 'Unauthorized action'); 
        }


        $orderline->delivery->update(['delivery_status' => 3]);

        return redirect()->back()->with('success', 'Order canceled successfully');
    }
}
