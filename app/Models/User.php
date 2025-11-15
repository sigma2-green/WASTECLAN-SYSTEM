<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The primary key for the model.
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'profile_photo',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /* ==========================
     |  RELATIONSHIPS
     ========================== */

    /**
     * 🏠 Each user (resident) may have one resident profile.
     */
    public function resident()
    {
        return $this->hasOne(Resident::class, 'user_id');
    }

    /**
     * 🚛 Each user (collector) may have one collector profile.
     */
    public function collector()
    {
        return $this->hasOne(Collection::class, 'user_id');
    }

    /**
     * 📋 A user can submit many reports.
     */
    public function reports()
    {
        return $this->hasMany(Issue::class, 'user_id');
    }

    /**
     * 💰 A user can have many incentive transactions.
     */
    public function incentiveTransactions()
    {
        return $this->hasMany(Incentive::class, 'user_id');
    }

    /* ==========================
     |  ROLE HELPERS
     ========================== */

    /**
     * Check if user is an admin.
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user is a collector.
     */
    public function isCollector(): bool
    {
        return $this->role === 'collector';
    }

    /**
     * Check if user is a resident.
     */
    public function isResident(): bool
    {
        return $this->role === 'resident';
    }
}


