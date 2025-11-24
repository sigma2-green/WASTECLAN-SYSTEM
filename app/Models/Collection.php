<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;

    protected $fillable = [
        'resident_id',
        'bin_id',
        'status',
    ];

    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }

    public function bin()
    {
        return $this->belongsTo(Bin::class);
    }
}
