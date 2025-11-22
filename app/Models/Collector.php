<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Route;
use App\Models\Bin;
use App\Models\SafetyReport;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Collector extends Model
{
    protected $fillable = [
        'user_id'=> $user->id,
        'vehicle_number'=> 'KBC-123V',
        'status'=>'active', // e.g., active/inactive
    ];

    /* ==========================
     |  RELATIONSHIPS
     ========================== */

    /**
     * Link to the User account
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Routes assigned to this collector
     */
    public function routes(): BelongsToMany
    {
        return $this->belongsToMany(Route::class, 'collector_route', 'collector_id', 'route_id')->withTimestamps();
    }

    /**
     * Bins accessible via assigned routes
     */
    public function bins(): HasMany
    {
        // Using hasManyThrough via Route
        return $this->hasManyThrough(
         Bin::class,
         Route::class, 
          'id',        // Foreign key on Route table (route id)
         'route_id',  // Foreign key on Bin table
         'id',        // Local key on Collector table (id)
         'id'         // Local key on Route table (id)
        );
    }

    /**
     * Safety reports submitted by the collector
     */
    public function safetyReports(): HasMany
    {
        return $this->hasMany(SafetyReport::class, 'collector_id');
    }

    /* ==========================
     |  HELPER METHODS
     ========================== */

    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    public function isInactive(): bool
    {
        return $this->status === 'inactive';
    }
}

