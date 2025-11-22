<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'profile_photo',
        'avatar',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /* ==========================
     |  RELATIONSHIPS
     ========================== */

    /**
     * 🏠 Each user (resident) may have one resident profile.
     */
    public function resident(): HasOne
    {
        return $this->hasOne(Resident::class, 'user_id');
    }

    /**
     * 🚛 Each user (collector) may have one collector profile.
     */
    public function collector(): HasOne
    {
        return $this->hasOne(Collector::class, 'user_id');
    }

    /**
     * 🛣️ Routes assigned to the collector (many-to-many)
     */
    public function routes(): BelongsToMany
    {
        return $this->belongsToMany(Route::class, 'collector_route', 'collector_id', 'route_id')->withTimestamps();
    }

    /**
     * 🗑️ Bins accessible via assigned routes
     */
    public function bins(): HasManyThrough
    {
        return $this->hasManyThrough(
            Bin::class,
            Route::class,
            'id', // Foreign key on Route table? We'll use route_id in Bin table
            'route_id', // Foreign key on Bin table
            'id', // Local key on User table
            'id'  // Local key on Route table
        );
    }

    /**
     * 📝 Safety reports submitted by collector
     */
    public function safetyReports(): HasMany
    {
        return $this->hasMany(SafetyReport::class, 'collector_id');
    }

    /**
     * 📋 A user can submit many general reports (residents)
     */
    public function reports(): HasMany
    {
        return $this->hasMany(Issue::class, 'user_id');
    }

    /**
     * 💰 Incentive transactions
     */
    public function incentiveTransactions(): HasMany
    {
        return $this->hasMany(Incentive::class, 'user_id');
    }

    /* ==========================
     |  ROLE HELPERS
     ========================== */

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isCollector(): bool
    {
        return $this->role === 'collector';
    }

    public function isResident(): bool
    {
        return $this->role === 'resident';
    }
}




