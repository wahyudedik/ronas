<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampusHighlight extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category_label',
        'description',
        'image',
        'stat_one_icon',
        'stat_one_label',
        'stat_two_icon',
        'stat_two_label',
        'sort_order',
        'is_active',
    ];
}
