<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampusMapAction extends Model
{
    use HasFactory;

    protected $fillable = [
        'label',
        'url',
        'icon_class',
        'sort_order',
        'is_active',
    ];
}
