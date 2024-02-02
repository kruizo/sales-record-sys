<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'employee_id',
        'delivery_date',
        'delivery_time',
        'delivery_status',
        'delivery_address',
        'map_reference',
        'special_instruction',
        'date_delivered'

    ];
    protected $casts = [
        'delivery_date' => 'date',
        'delivery_time' => 'datetime:H:i',
        'date_delivered' => 'datetime',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
