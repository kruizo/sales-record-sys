<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'address_id',
        'firstname',
        'lastname',
        'contactnum',
        'email',
    ];

    public function user()
    {
        return $this->belongsTo(Customer::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }
    public function deliveryEmployee()
    {
        return $this->hasOne(DeliveryEmployee::class);
    }
}
