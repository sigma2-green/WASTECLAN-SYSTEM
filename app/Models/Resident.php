<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\BinAlerts;
use App\Models\IncentiveTransaction;


class Resident extends Model
{
    protected $fillable = [
        'user_id',
        'address',
        'house_number',
        'status', // e.g., active/inactive
    ];

    /* ==========================
     |  RELATIONSHIPS
     ========================== */

    /**
     * 👤 Each resident belongs to one user.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * 🗑️ Bin alerts submitted by this resident
     */
    public function binAlerts()
    {
        return $this->hasMany(BinAlerts::class, 'resident_id');
    }

    /**
     * 💰 Incentive transactions for this resident
     */
    public function incentives()
    {
        return $this->hasMany(IncentiveTransaction::class, 'user_id', 'user_id');
    }
}
