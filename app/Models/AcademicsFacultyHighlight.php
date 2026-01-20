<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicsFacultyHighlight extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'role',
        'image',
        'linkedin_url',
        'twitter_url',
        'email',
        'sort_order',
        'is_active',
    ];
}
