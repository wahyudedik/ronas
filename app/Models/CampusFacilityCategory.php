<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CampusFacilityCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'theme',
        'icon_class',
        'image',
        'button_label',
        'button_url',
        'description',
        'sort_order',
        'is_active',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(CampusFacilityItem::class, 'category_id');
    }
}
