<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandingSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'title',
        'subtitle',
        'description',
        'sort_order',
        'is_active',
    ];
}
