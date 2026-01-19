<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandingEventItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category',
        'time_text',
        'date_day',
        'date_month',
        'description',
        'location',
        'participants',
        'image',
        'link_url',
        'sort_order',
        'is_active',
    ];
}
