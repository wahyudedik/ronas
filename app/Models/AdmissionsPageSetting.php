<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdmissionsPageSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_title',
        'breadcrumb_title',
        'steps_title',
        'is_active',
    ];
}
