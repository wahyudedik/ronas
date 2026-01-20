<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CampusVirtualTourFeature extends Model
{
    use HasFactory;

    protected $fillable = [
        'campus_virtual_tour_id',
        'title',
        'description',
        'icon_class',
        'sort_order',
        'is_active',
    ];

    public function tour(): BelongsTo
    {
        return $this->belongsTo(CampusVirtualTour::class, 'campus_virtual_tour_id');
    }
}
