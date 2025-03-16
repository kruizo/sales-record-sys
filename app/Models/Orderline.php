<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class Orderline extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'water_id',
        'quantity',
        'subtotal',
        'is_archived'
    ];

    protected $casts = [
        'is_archived' => 'boolean',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function delivery()
    {
        return $this->hasOne(Delivery::class);
    }

    public function water()
    {
        return $this->belongsTo(Water::class);
    }

    public function showReceipt($id)
    {
        $order = Order::with('orderline.water')->find($id);

        if (!$order) {
            return back()->with('error', 'Order not found.');
        }

        return view('receipt', compact('order'));
    }
}
