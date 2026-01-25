<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\AlumniStory;
use App\Models\User;

class AlumniStorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::role('user')->get();
        if ($users->isEmpty()) {
            // Fallback if no regular users exist
            $user = User::first();
            $userId = $user ? $user->id : null;
        } else {
            $userId = $users->random()->id;
        }

        $stories = [
            [
                'title' => 'Building a Tech Startup from Scratch',
                'alumni_name' => 'John Doe',
                'graduation_year' => '2015',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'featured_image' => 'storage/alumni/stories/story-1.jpg',
                'status' => 'approved',
            ],
            [
                'title' => 'My Journey in Medical Science',
                'alumni_name' => 'Jane Smith',
                'graduation_year' => '2018',
                'content' => 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                'featured_image' => 'storage/alumni/stories/story-2.jpg',
                'status' => 'approved',
            ],
            [
                'title' => 'Leading Sustainable Energy Projects',
                'alumni_name' => 'Michael Johnson',
                'graduation_year' => '2012',
                'content' => 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.',
                'featured_image' => 'storage/alumni/stories/story-3.jpg',
                'status' => 'approved',
            ],
            [
                'title' => 'Teaching in Remote Areas',
                'alumni_name' => 'Sarah Williams',
                'graduation_year' => '2020',
                'content' => 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                'featured_image' => 'storage/alumni/stories/story-4.jpg',
                'status' => 'approved',
            ],
            [
                'title' => 'Pending Story Approval',
                'alumni_name' => 'New Grad',
                'graduation_year' => '2023',
                'content' => 'Just graduated and looking forward to the future.',
                'featured_image' => null,
                'status' => 'pending',
            ],
        ];

        foreach ($stories as $story) {
            AlumniStory::updateOrCreate(
                ['slug' => Str::slug($story['title'])],
                array_merge($story, ['user_id' => $userId])
            );
        }
    }
}
