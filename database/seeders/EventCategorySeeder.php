<?php

namespace Database\Seeders;

use App\Models\EventCategory;
use Illuminate\Database\Seeder;

class EventCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Academic', 'slug' => 'academic', 'description' => 'Academic events and conferences'],
            ['name' => 'Sports', 'slug' => 'sports', 'description' => 'Sports tournaments and activities'],
            ['name' => 'Arts & Culture', 'slug' => 'arts-culture', 'description' => 'Art exhibitions and cultural festivals'],
        ];

        foreach ($categories as $category) {
            EventCategory::firstOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}
