<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdmissionsRequestInfoSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'form_action',
        'submit_label',
        'program_placeholder',
        'is_active',
    ];
}
