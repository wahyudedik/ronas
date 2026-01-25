<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonationCampaign extends Model
{
    protected $fillable = [
        'campaign_name',
        'slug',
        'description',
        'target_amount',
        'current_amount',
        'deadline',
        'payment_methods',
        'featured_image',
        'is_active'
    ];

    protected $casts = [
        'deadline' => 'date',
        'payment_methods' => 'array',
        'is_active' => 'boolean',
        'target_amount' => 'decimal:2',
        'current_amount' => 'decimal:2',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
