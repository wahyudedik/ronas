<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlumniEvent extends Model
{
    protected $fillable = [
        'event_name',
        'slug',
        'description',
        'date',
        'location',
        'registration_link',
        'featured_image',
        'is_active'
    ];

    protected $casts = [
        'date' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
