<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'id'; // Use if your PK isn’t 'id'

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];

    // 🏠 Relationship: one user → one resident profile
    /*public function resident()
    {
        return $this->hasOne(Resident::class, 'resident_id');
    } 
    
    // 🚛 Relationship: one user → one collector profile
    /*public function collector()
    {
        return $this->hasOne(Collector::class, 'collector_id');
    }*/

    // 📋 Relationship: user → many reports
   /* public function reports()
    {
        return $this->hasMany(Report::class, 'user_id');
    }*/

    // 💰 Relationship: user → many incentive transactions
    /*public function incentiveTransactions()
    {
        return $this->hasMany(IncentiveTransaction::class, 'user_id');
    }*/
}

