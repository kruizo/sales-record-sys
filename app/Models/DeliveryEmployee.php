<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryEmployee extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'isAvailable',
        'total_deliveries',
        'is_archived'
    ];

    protected $casts = [
        'isAvailable' => 'boolean',
        'is_archived' => 'boolean',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
