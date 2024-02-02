<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Customer;
use App\Models\Water;
use App\Models\Orderline;
use App\Models\Delivery;
use App\Models\DeliveryEmployee;
use App\Models\Order;
use App\Models\Address;

class OrderController extends Controller
{
    public function placeOrderTest()
    {
        return 'Test Place Order';
    }

    public function showOrder()
    {
        $user = auth()->user();
        $customer = Customer::where('user_id', $user->id)->first();
        $address = $customer ? $customer->address : null;
        //get water data
        $waters = Water::all();
        return view('/order', compact('customer', 'address', 'waters'));
    }

    public function placeOrder(Request $request)
    {


        $customerId = auth()->user()->customer->id;
        $purchaseType = $request->input('delivery_method');

        $paymentType = ($purchaseType == 'Walk-in') ? null : $request->input('payment_method');
        $mapReference = $request->input('mapreference');

        $deliveryDate = $request->input('expected_date');
        $deliveryTime = $request->input('expected_time');
        $specialInstructions = $request->input('special_instructions');
        $employeeId = DeliveryEmployee::where('isAvailable', 1)->first()->id;

        $order = Order::create([
            'customer_id' => $customerId,
            'purchase_type' => $purchaseType,
            'payment_type' => $paymentType,
        ]);

        //  $address = Customer::find($customerId)->address;
        $deliveryAddress = $request->input('street_address') . ', ' .
            $request->input('barangay') . ', ' .
            $request->input('city') . ', ' .
            $request->input('province') . ', ' .
            $request->input('zip');

        Delivery::create([
            'order_id' => $order->id,
            'employee_id' => $employeeId,
            'delivery_date' => $deliveryDate,
            'delivery_time' => $deliveryTime,
            'delivery_address' => $deliveryAddress,
            'map_reference' => $mapReference,
            'special_instruction' => $specialInstructions,
        ]);

        $totalOrders = 0;

        foreach ($request->input() as $key => $value) {
            if (strpos($key, 'product') !== false && $value > 0) {
                $waterId = substr($key, 7); // Extract water ID from input name

                // Find water cost from the database
                $waterCost = Water::where('id', $waterId)->value('cost');

                // Calculate subtotal
                $subtotal = $value * $waterCost;

                // Create order line
                Orderline::create([
                    'order_id' => $order->id,
                    'water_id' => $waterId,
                    'quantity' => $value,
                    'subtotal' => $subtotal,
                ]);
                $totalOrders++;
            }
        }

        return redirect()->route('profile/myorders');
    }
}
