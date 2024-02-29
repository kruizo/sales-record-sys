<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;
use App\Models\Water;
use App\Models\Orderline;
use App\Models\Delivery;
use App\Models\DeliveryEmployee;
use App\Models\Order;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Redirect;
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
            'payment_method' => ['required', 'string'],
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
        $deliveryAddress = $request->input('delivery_address');
        $totalOrder = 0;

        DB::beginTransaction();

        try {
            $order = Order::create([
                'customer_id' => $customerId,
                'purchase_type' => 'Delivery',
                'payment_type' => $paymentType,
            ]);

            $deliveryfee = 0;
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
                    $deliveryfee = $orderline->delivery->delivery_fee;
                    $totalOrder += $subtotal;
                }
            }
            $totalOrder += $deliveryfee;
            $order->update(['total' => $totalOrder]);

            DB::commit();
            return redirect()->route('profile/myorders');
        } catch (\Exception $e) {
            DB::rollback();
            $errorMessage = $e->getMessage();
            return back()->withError($errorMessage);
        }
    }

    public function cancelOrder($id)
    {
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

    public function markOrder($id, $status)
    {
        try {
            $order = Order::findOrFail($id);

            foreach ($order->orderline as $orderline) {
                $delivery = $orderline->delivery;
                if ($delivery) {
                    $delivery->delivery_status = $status;
                    $delivery->save();
                }
            }
            return back()->withSuccess('Order set as completed successfully');
        } catch (\Exception $e) {
            return back()->withError('Failed to update delivery status');
        }
    }

    public function markArchive($id, $status)
    {
        try {
            $order = Order::findOrFail($id);

            $order->is_archived = $status;
            $order->save();

            foreach ($order->orderline as $orderline) {
                if ($orderline) {
                    $orderline->is_archived = $status;
                }
            }
            return Redirect::back()->withSuccess('Order set as completed successfully');
        } catch (\Exception $e) {
            return back()->withError('Failed to update delivery status');
        }
    }
}
