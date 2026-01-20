<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampusMapCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'key',
        'icon_class',
        'sort_order',
        'is_active',
    ];
}
