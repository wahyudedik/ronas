<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutMissionVision extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'title',
        'description',
        'sort_order',
        'is_active',
    ];
}
