<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'is_archived'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_admin' => 'boolean',
        'is_archived' => 'boolean',
    ];


    public function firstname()
    {
        return optional($this->registeredCustomer)->customer->firstname;
    }
     public function lastname()
    {
        return  optional($this->registeredCustomer)->customer->lastname;
    }
    public function fullname()
    {
        return $this->registeredCustomer->customer->firstname . ' ' . $this->registeredCustomer->customer->lastname;
    }

    public function isAdmin()
    {
        return $this->is_admin;
    }

    public function isVerified()
    {
        return $this->email_verified_at !== null;
    }

    public function registeredCustomer()
    {
        return $this->hasOne(RegisteredCustomer::class);
    }

    public function order()
    {
        return $this->hasOne(Order::class);
    }
    public function employee()
    {
        return $this->hasOne(Employee::class);
    }
}
