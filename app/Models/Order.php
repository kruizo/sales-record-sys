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
        'delivery_fee',
        'total',
        'is_archived'
    ];

    protected $casts = [
        'is_archived' => 'boolean',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }


    public function orderline()
    {
        return $this->hasMany(Orderline::class);
    }
}
