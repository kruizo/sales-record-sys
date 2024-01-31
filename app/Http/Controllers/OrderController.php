<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Customer;
use App\Models\Water;

class OrderController extends Controller
{

    public function showOrder()
    {
        $user = auth()->user();
        $customer = Customer::where('user_id', $user->id)->first();
        $address = $customer ? $customer->address : null;
        //get water data
        $waters = Water::all();
        return view('/order', compact('customer', 'address', 'waters'));
    }
}
