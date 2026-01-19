<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AboutLeadershipHighlight extends Model
{
    use HasFactory;

    protected $fillable = [
        'about_leadership_section_id',
        'icon_class',
        'title',
        'description',
        'sort_order',
        'is_active',
    ];

    public function leadershipSection(): BelongsTo
    {
        return $this->belongsTo(AboutLeadershipSection::class, 'about_leadership_section_id');
    }
}
