<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CampusVirtualTour extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'primary_label',
        'primary_url',
        'secondary_label',
        'secondary_url',
        'video_url',
        'badge_text',
        'is_active',
    ];

    public function features(): HasMany
    {
        return $this->hasMany(CampusVirtualTourFeature::class, 'campus_virtual_tour_id');
    }
}
