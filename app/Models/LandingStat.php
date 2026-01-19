<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandingStat extends Model
{
    use HasFactory;

    protected $fillable = [
        'label',
        'description',
        'value',
        'suffix',
        'icon_class',
        'sort_order',
        'is_active',
    ];
}
