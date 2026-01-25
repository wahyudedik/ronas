<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AlumniStory extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'content',
        'alumni_name',
        'graduation_year',
        'featured_image',
        'status',
        'user_id'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
