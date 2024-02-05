<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Water extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'type', 'description', 'cost',   'is_archived'
    ];

    protected $casts = [
        'is_archived' => 'boolean',
    ];
}
