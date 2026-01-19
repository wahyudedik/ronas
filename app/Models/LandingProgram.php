<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandingProgram extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'duration_text',
        'degree_text',
        'image',
        'badge_text',
        'meta_one',
        'meta_two',
        'is_featured',
        'sort_order',
        'is_active',
    ];
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandingProgram extends Model
{
    protected $fillable = [
        'title',
        'description',
        'duration',
        'level',
        'image_path',
        'badge_text',
        'sort_order',
        'is_active',
    ];
}
