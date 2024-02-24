<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;

    protected $fillable = [
        'orderline_id',
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
        return $this->deliverystatus->status ?? 'Unknown';
    }

    public function orderline()
    {
        return $this->belongsTo(Orderline::class);
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
