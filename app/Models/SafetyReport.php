<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SafetyReport extends Model
{
    protected $fillable = [
        'collector_id',
        'report_type',
        'description',
        'photo',
    ];

    /**
     * The collector (user) who submitted the report
     */
    public function collector(): BelongsTo
    {
        // Links to the Collector model via user_id
        return $this->belongsTo(Collector::class, 'collector_id', 'user_id');
    }
}

