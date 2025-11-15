<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Sorting extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',        // name of the sorting guide
        'description',  // detailed description or instructions
        'category',     // optional: type/category of sorting
        'status'        // optional: active/inactive
    ];
}

