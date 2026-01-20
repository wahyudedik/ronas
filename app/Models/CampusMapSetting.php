<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampusMapSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'embed_url',
        'location_title',
        'location_address',
        'stat_one_icon',
        'stat_one_label',
        'stat_two_icon',
        'stat_two_label',
        'is_active',
    ];
}
