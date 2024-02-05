<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisteredCustomer extends Model
{
    use HasFactory;

      protected $fillable = [
        'customer_id',
        'user_id',
        'is_archived'
    ];

      protected $casts = [
        'is_archived' => 'boolean',
    ];
    public function get(){
       $user = auth()->user();
        $registeredCustomer = $this->where('user_id', $user->id)->first();
        $address = $registeredCustomer ? $registeredCustomer->customer->address : null;

        return $registeredCustomer->customer ?? null;
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }



}
