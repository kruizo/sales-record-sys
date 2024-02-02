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

class OrderController extends Controller
{


    public function showOrder()
    {
        $user = auth()->user();
        $customer = Customer::where('user_id', $user->id)->first();
        if (!$customer) {
            return redirect()->route('verified.setup');
        }
        $address = $customer ? $customer->address : null;
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
        ]);

        $customerId = auth()->user()->customer->id;
        $paymentType = $request->input('payment_method');
        $mapReference = $request->input('mapreference');
        $deliveryDate = $request->input('expected_date');
        $deliveryTime = $request->input('expected_time');
        $specialInstructions = $request->input('special_instructions');
        $employeeId = DeliveryEmployee::where('isAvailable', 1)->first()->id;
        $order = Order::create([
            'customer_id' => $customerId,
            'purchase_type' => 'Delivery',
            'payment_type' => $paymentType,
        ]);

        $deliveryAddress = $request->input('delivery_address');

        Delivery::create([
            'order_id' => $order->id,
            'employee_id' => $employeeId,
            'delivery_date' => $deliveryDate ?? Date::now()->toDateString(),
            'delivery_time' => $deliveryTime ?? Date::now()->toTimeString(),
            'delivery_address' => $deliveryAddress,
            'map_reference' => $mapReference,
            'special_instruction' => $specialInstructions,
        ]);

        $totalOrders = 0;

        foreach ($request->input() as $key => $value) {
            if (strpos($key, 'product_') !== false && $value > 0) {
                $waterId = substr($key, 8);
                $water = Water::find($waterId);

                $subtotal = $value * $water->cost;

                Orderline::create([
                    'order_id' => $order->id,
                    'water_id' => $water->id,
                    'quantity' => $value,
                    'subtotal' => $subtotal,
                ]);
                $totalOrders++;
            }
        }

        return redirect()->route('profile/myorders');
    }
}
