<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Route;
use App\Models\BinAlerts;


class Bin extends Model
{
    protected $fillable = [
        'location',
        'status',
        'route_id',
    ];

    /**
     * Route this bin belongs to
     */
    public function route(): BelongsTo
    {
        return $this->belongsTo(Route::class);
    }

    /**
     * Alerts triggered for this bin
     */
    public function alerts(): HasMany
    {
        return $this->hasMany(BinAlerts::class, 'bin_id');
    }
}

