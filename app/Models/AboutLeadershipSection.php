<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AboutLeadershipSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'subtitle',
        'title',
        'description',
        'image',
        'experience_years',
        'experience_text',
        'sort_order',
        'is_active',
    ];

    public function highlights(): HasMany
    {
        return $this->hasMany(AboutLeadershipHighlight::class)->orderBy('sort_order');
    }

    public function members(): HasMany
    {
        return $this->hasMany(AboutLeadershipMember::class)->orderBy('sort_order');
    }
}
