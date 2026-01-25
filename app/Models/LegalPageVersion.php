<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LegalPageVersion extends Model
{
    use HasFactory;

    protected $fillable = [
        'legal_page_id',
        'content',
        'version',
        'created_by',
    ];

    public function legalPage()
    {
        return $this->belongsTo(LegalPage::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
