<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandingStudentLifeItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'link_label',
        'link_url',
        'sort_order',
        'is_active',
    ];
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandingStudentLifeItem extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image_path',
        'cta_text',
        'cta_url',
        'sort_order',
        'is_active',
    ];
}
