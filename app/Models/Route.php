<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Route extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Collectors assigned to this route
     */
    public function collectors(): BelongsToMany
    {
        return $this->belongsToMany(
            Collector::class,
            'collector_route',
            'route_id',
            'collector_id'
        )->withTimestamps();
    }

    /**
     * Bins located along this route
     */
    public function bins(): HasMany
    {
        return $this->hasMany(Bin::class, 'route_id');
    }
}


