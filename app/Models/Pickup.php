<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pickup extends Model
{
    protected $fillable = [
        'resident_id',
        'collector_id',
        'bin_id',
        'route_id',
        'pickup_date',
        'status',
    ];

    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }

    public function collector()
    {
        return $this->belongsTo(Collector::class);
    }

    public function bin()
    {
        return $this->belongsTo(Bin::class);
    }

    public function route()
    {
        return $this->belongsTo(Route::class);
    }
}

