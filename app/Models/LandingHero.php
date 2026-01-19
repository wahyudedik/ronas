<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandingHero extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'primary_label',
        'primary_url',
        'secondary_label',
        'secondary_url',
        'image',
        'badge_text',
        'badge_icon',
        'stat_one_value',
        'stat_one_label',
        'stat_two_value',
        'stat_two_label',
        'stat_three_value',
        'stat_three_label',
        'event_day',
        'event_month',
        'event_title',
        'event_description',
        'event_button_label',
        'event_button_url',
        'event_countdown_text',
        'is_active',
        'sort_order',
    ];
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandingHero extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'badge_text',
        'badge_icon',
        'primary_cta_text',
        'primary_cta_url',
        'secondary_cta_text',
        'secondary_cta_url',
        'image_path',
        'is_active',
    ];
}
