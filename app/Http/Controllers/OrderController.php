<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;
use App\Models\Water;
use App\Models\Orderline;
use App\Models\Delivery;
use App\Models\DeliveryEmployee;
use App\Models\DeliveryFee;
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

        if (Customer::where('email', $user->email)->doesntExist()) {
            return redirect()->route('profile.setup');
        }

        $registeredcustomer = $user->registeredcustomer;

        $customer = $registeredcustomer->customer ?? null;
        $address = $registeredcustomer ? $customer->address : null;
        $waters = Water::all();
        return view('/order', compact('customer', 'address', 'waters'));
    }

    public function showReceipt($orderId){

        $order = Order::with('orderline.water')->findOrFail($orderId);

        return view('reports.receipt', compact('order'));
    }

    public function create(Request $request)
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
        $user = Auth::user();

        $customerId = auth()->user()->registeredcustomer->customer_id;
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

            
            {$deliveryfee = DeliveryFee::find(1)->fee;
            $order = Order::create([
                'customer_id' => $customerId,
                'purchase_type' => 'Delivery',
                'payment_type' => $paymentType,
                'delivery_fee' => $deliveryfee,
            ]);

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

                    
                    $totalOrder += $subtotal;
                }
            }
            $totalOrder += $deliveryfee;

            $delivery = Delivery::create([
                'order_id' => $order->id,
                'employee_id' => $employeeId,
                'delivery_date' => $deliveryDate ?? Date::now()->toDateString(),
                'delivery_time' => $deliveryTime ?? Date::now()->toTimeString(),
                'delivery_address' => $deliveryAddress,
                'map_reference' => $mapReference,
                'special_instruction' => $specialInstructions,
            ]);

            $order->update(['total' => $totalOrder]);

            DB::commit();
            return redirect()->route('profile.myorders');}
        } catch (\Exception $e) {
            DB::rollback();
            $errorMessage = $e->getMessage();
            dd($errorMessage);
            return back()->withError("Something occured. $errorMessage");
        }
    }

    public function update(Request $request, $id)
    {
        $orderline = Orderline::with(['order.customer.registeredcustomer', 'delivery'])->findOrFail($id);
    
        $authenticatedUserId = Auth::id();
    
        if (!$orderline->order || !$orderline->order->customer || !$orderline->order->customer->registeredcustomer) {
            abort(404, 'Customer information not found');
        }
    
        $orderCustomerId = $orderline->order->customer->registeredcustomer->user_id;
    
        if ($authenticatedUserId !== $orderCustomerId) {
            abort(403, 'Unauthorized action.');
        }
    
        $orderline->delivery->update(['delivery_status' => 3]);
    
        return back()->with('success', 'Order updated successfully.');
    }


    public function cancelOrder(Request $request, $id)
    {
        $order = Order::with('delivery')->findOrFail($id);
        $user = Auth::user();
    
        if ($user->isAdmin()) {
            $order->delivery->update(['delivery_status' => 3]);
            return back()->with('success', 'Order canceled successfully');
        }
    
        if ($user->id === $order->customer->registeredcustomer->user_id) {
            $order->delivery->update(['delivery_status' => 3]);
            return back()->with('success', 'Order canceled successfully');
        }
    
        abort(403, 'Unauthorized action.');
    }

    public function removeOrderline($orderlineId)
    {
        $orderline = Orderline::findOrFail($orderlineId);
        $orderline->delete();
    }

    public function updateOrderArchiveStatus($id, $status)
    {
        $order = Order::findOrFail($id);

        $order->is_archived = $status;
        $order->save();

        foreach ($order->orderline as $orderline) {
            if ($orderline ) {
                 $orderline->is_archived = $status;   
            }
        }
    }

}
