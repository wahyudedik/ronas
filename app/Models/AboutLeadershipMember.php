<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AboutLeadershipMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'about_leadership_section_id',
        'name',
        'role',
        'bio',
        'image',
        'social_links',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'social_links' => 'array',
    ];

    public function leadershipSection(): BelongsTo
    {
        return $this->belongsTo(AboutLeadershipSection::class, 'about_leadership_section_id');
    }
}
