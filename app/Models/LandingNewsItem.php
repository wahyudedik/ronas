<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandingNewsItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category',
        'excerpt',
        'author_name',
        'author_image',
        'published_at',
        'image',
        'link_url',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'published_at' => 'date',
        'is_active' => 'boolean',
    ];
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandingNewsItem extends Model
{
    protected $fillable = [
        'category',
        'title',
        'excerpt',
        'author_name',
        'author_image_path',
        'published_at',
        'image_path',
        'link_url',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'published_at' => 'date',
    ];
}
