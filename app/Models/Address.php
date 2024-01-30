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

    // Define the relationship with Customer model
    public function customer()
    {
        return $this->hasOne(Customer::class);
    }
}
