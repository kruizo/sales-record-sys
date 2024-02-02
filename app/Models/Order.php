<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'purchase_type',
        'payment_type',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function orderline()
    {
        return $this->hasOne(Customer::class);
    }
}
