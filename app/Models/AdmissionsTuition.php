<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdmissionsTuition extends Model
{
    use HasFactory;

    protected $fillable = [
        'program',
        'tuition',
        'fees',
        'sort_order',
        'is_active',
    ];
}
