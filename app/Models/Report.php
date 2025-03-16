<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $fillable = [
        'reports',
        'name',
        'description',
        'status',
        'order_id',
        'customer_id',
        'delivery_id',
        'total_amount'
    ];
}

