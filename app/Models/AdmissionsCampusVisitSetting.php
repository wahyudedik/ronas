<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdmissionsCampusVisitSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'image_caption',
        'button_label',
        'button_url',
        'virtual_label',
        'virtual_url',
        'is_active',
    ];
}
