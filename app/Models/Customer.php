<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname', 'lastname', 'contactnum', 'email', 'address_id', 'is_archived'
    ];

    protected $casts = [
        'is_archived' => 'boolean',
    ];

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function registeredcustomer()
    {
        return $this->hasOne(registeredcustomer::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
