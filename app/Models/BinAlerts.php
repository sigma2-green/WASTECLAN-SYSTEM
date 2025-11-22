<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Bin; 
class BinAlerts extends Model
{
    protected $fillable = [
        'bin_id',
        'resident_id',
        'status',
        'message',
        'photo',
    ];

    /**
     * The bin this alert relates to
     */
    public function bin(): BelongsTo
    {
        return $this->belongsTo(Bin::class);
    }

    /**
     * The resident who initiated the alert
     */
    public function resident(): BelongsTo
    {
        return $this->belongsTo(Resident::class);
    }
}


