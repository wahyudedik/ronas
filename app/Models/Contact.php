<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'address',
        'phone',
        'email',
        'latitude',
        'longitude',
        'operating_hours',
        'social_media_links',
    ];

    protected $casts = [
        'operating_hours' => 'array',
        'social_media_links' => 'array',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
    ];
}
