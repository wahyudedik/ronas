<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandingStudentLifeItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category',
        'description',
        'image',
        'icon_class',
        'badge_text',
        'link_label',
        'link_url',
        'sort_order',
        'is_active',
    ];
}
