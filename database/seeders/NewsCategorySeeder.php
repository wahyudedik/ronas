<?php

namespace Database\Seeders;

use App\Models\NewsCategory;
use Illuminate\Database\Seeder;

class NewsCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Politics', 'slug' => 'politics', 'description' => 'Latest updates in politics'],
            ['name' => 'Business', 'slug' => 'business', 'description' => 'Business news and insights'],
            ['name' => 'Science', 'slug' => 'science', 'description' => 'Scientific discoveries and research'],
            ['name' => 'Technology', 'slug' => 'technology', 'description' => 'Tech trends and innovations'],
            ['name' => 'Innovation', 'slug' => 'innovation', 'description' => 'Creative solutions and future tech'],
        ];

        foreach ($categories as $category) {
            NewsCategory::firstOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}
