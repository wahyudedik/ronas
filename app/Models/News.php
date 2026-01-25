<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class News extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'excerpt',
        'content',
        'author_id',
        'author_image', // Keep for backward compatibility or direct upload
        'image',
        'published_at',
        'is_active',
        'sort_order',
        'status',
        'meta_keywords',
        'meta_description'
    ];

    protected $casts = [
        'published_at' => 'date',
        'is_active' => 'boolean',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(NewsCategory::class, 'category_id');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function scopePublished(Builder $query)
    {
        return $query->where('status', 'published')
            ->where('is_active', true)
            ->whereDate('published_at', '<=', now());
    }
}
