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
        'date_delivered',
        'is_archived'
    ];
    protected $casts = [
        'delivery_date' => 'date',
        'delivery_time' => 'datetime:H:i',
        'date_delivered' => 'datetime',
        'is_archived' => 'boolean',
    ];

    public function getStatusText()
    {
        return $this->deliverystatus->name ?? 'N/A';
    }

    public function getStatus()
    {
        return $this->deliverystatus->status ?? 'N/A';
    }

    public function getFormattedDeliveryDate()
    {
        return $this->delivery_date->format('F j, Y');
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function employee()
    {
        return $this->belongsTo(DeliveryEmployee::class);
    }
    public function deliverystatus()
    {
        return $this->belongsTo(DeliveryStatus::class, 'delivery_status');
    }
}
