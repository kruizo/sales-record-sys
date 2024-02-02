<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'streetaddress',
        'barangay',
        'province',
        'city',
        'zip',
    ];

    public function customer()
    {
        return $this->hasOne(Customer::class);
    }
    public function getFullAddressAttribute()
    {
        return "{$this->streetaddress}, {$this->barangay}, {$this->city}, {$this->province}, {$this->zip}";
    }
}
