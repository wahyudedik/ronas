<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandingEvent extends Model
{
    protected $fillable = [
        'category',
        'title',
        'description',
        'event_date',
        'event_time',
        'location',
        'image_path',
        'cta_text',
        'cta_url',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'event_date' => 'date',
    ];
}
