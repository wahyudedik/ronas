<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GetInvolvedOption extends Model
{
    protected $fillable = [
        'title',
        'description',
        'type',
        'requirements',
        'contact_info',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
