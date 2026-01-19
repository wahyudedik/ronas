<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandingSectionSetting extends Model
{
    protected $fillable = [
        'key',
        'title',
        'subtitle',
        'description',
        'is_active',
    ];
}
