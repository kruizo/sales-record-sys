<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisteredCustomer extends Model
{
    use HasFactory;

      protected $fillable = [
        'customer_id',
        'user_id',
        'is_archived'
    ];

      protected $casts = [
        'is_archived' => 'boolean',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }



}
