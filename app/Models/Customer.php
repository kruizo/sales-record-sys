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
        return $this->hasOne(Address::class);
    }

    public function getFullAddress()
    {
        return "{$this->address->streetaddress}, {$this->address->barangay}, {$this->address->city}, {$this->address->province}, {$this->address->zip}";
    }

    public function registeredcustomer()
    {
        return $this->hasOne(registeredcustomer::class);
    }
    public function hasProfile()
    {
        return $this->registeredcustomer()->exists();
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
