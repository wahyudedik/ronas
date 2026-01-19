<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdmissionsRequirementSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'note',
        'is_active',
    ];
}
