<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use App\Models\Address;
use App\Models\RegisteredCustomer;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function store(Request $request)
    {   
        $request->validate([
            'email' => 'required|email',
            'first_name' => 'required',
            'last_name' => 'required',
            'contact_number' => 'required|numeric',
            'street_address' => 'required',
            'province' => 'required',
            'barangay' => 'required',
            'city' => 'required',
            'zip' => 'required|numeric',
        ]);

        if (Customer::where('email', $request->email)->exists()) {
            return back()->withErrors(['Customer already created.']);
        }

        DB::beginTransaction();
        try{
            $customer = Customer::create([
                'firstname' => $request->input('first_name'),
                'lastname' => $request->input('last_name'),
                'contactnum' => $request->input('contact_number'),
                'email' => $request->input('email'),
            ]);
    
            $customer->save(); 
    
            $address = Address::create([
                'customer_id' => $customer->id,
                'streetaddress' => $request->input('street_address'),
                'province' => $request->input('province'),
                'barangay' => $request->input('barangay'),
                'city' => $request->input('city'),
                'zip' => $request->input('zip'),
            ]);
    
            $address->save();
            
            $user = User::where('email', $customer->email)->first();

            if ($user) {
                RegisteredCustomer::firstOrCreate(
                    ['user_id' => $user->id], 
                    [
                        'customer_id' => $customer->id,
                        'address_id'  => $address->id,
                    ]
                );
            }
            DB::commit();
            return back()->with('success', 'Customer created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['Failed to create customer: ' . $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'contact_number' => 'required|numeric',
            'street_address' => 'required',
            'zip' => 'numeric',
        ]);

        try {
            $customer = Customer::findOrFail($id);
            $address = $customer->address; 
    
            $customer->update([
                'firstname' => $request->input('first_name'),
                'lastname' => $request->input('last_name'),
                'contactnum' => $request->input('contact_number'),
            ]);
    
            if ($address) {
                $address->update([
                    'streetaddress' => $request->input('street_address'),
                    'province' => $request->input('province'),
                    'barangay' => $request->input('barangay'),
                    'city' => $request->input('city'),
                    'zip' => $request->input('zip'),
                ]);
            }
    
            DB::commit();
            return back()->with('success', 'Customer updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack(); 
            return back()->withErrors(['Failed to update customer: ' . $e->getMessage()]);
        }


    }


    public function destroy(Request $request, $id)
    {
        DB::beginTransaction();
    
        try {
            $customer = Customer::findOrFail($id);
    
            Address::where('id', $customer->address_id)->delete();
    
            $customer->delete();
    
            DB::commit(); 
            return back()->with('success', 'Customer deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack(); 
            return back()->withErrors(['Failed to delete customer: ' . $e->getMessage()]);
        }
    }
    
    
}
