<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AboutHistoryMilestone extends Model
{
    use HasFactory;

    protected $fillable = [
        'about_history_id',
        'year',
        'description',
        'sort_order',
        'is_active',
    ];

    public function history(): BelongsTo
    {
        return $this->belongsTo(AboutHistory::class, 'about_history_id');
    }
}
