<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AboutHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'heading',
        'description',
        'image',
        'sort_order',
        'is_active',
    ];

    public function milestones(): HasMany
    {
        return $this->hasMany(AboutHistoryMilestone::class)->orderBy('sort_order');
    }
}
