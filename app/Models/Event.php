<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

class Event extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'description',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'venue',
        'address',
        'capacity',
        'registration_deadline',
        'status',
        'image',
        'registration_url',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'registration_deadline' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(EventCategory::class, 'category_id');
    }

    public function registrations(): HasMany
    {
        return $this->hasMany(EventRegistration::class);
    }

    public function scopeUpcoming(Builder $query)
    {
        return $query->where('status', 'upcoming')
            ->where('start_date', '>=', now())
            ->orderBy('start_date', 'asc');
    }

    public function scopePast(Builder $query)
    {
        return $query->where('start_date', '<', now())
            ->orderBy('start_date', 'desc');
    }
}
