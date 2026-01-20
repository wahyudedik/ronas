<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CampusFacilityItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'label',
        'icon_class',
        'sort_order',
        'is_active',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(CampusFacilityCategory::class, 'category_id');
    }
}
