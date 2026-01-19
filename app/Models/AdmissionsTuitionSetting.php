<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdmissionsTuitionSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'aid_title',
        'aid_description',
        'aid_button_label',
        'aid_button_url',
        'is_active',
    ];
}
