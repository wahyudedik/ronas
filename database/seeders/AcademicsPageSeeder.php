<?php

namespace Database\Seeders;

use App\Models\AcademicsFacultyHighlight;
use Illuminate\Database\Seeder;

class AcademicsPageSeeder extends Seeder
{
    public function run(): void
    {
        AcademicsFacultyHighlight::query()->delete();

        AcademicsFacultyHighlight::insert([
            [
                'name' => 'Dr. Michael Reynolds',
                'role' => 'Computer Science',
                'image' => 'College/assets/img/person/person-m-3.webp',
                'linkedin_url' => '#',
                'twitter_url' => '#',
                'email' => 'michael.reynolds@example.com',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Dr. Sarah Johnson',
                'role' => 'Psychology',
                'image' => 'College/assets/img/person/person-f-5.webp',
                'linkedin_url' => '#',
                'twitter_url' => '#',
                'email' => 'sarah.johnson@example.com',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Dr. Robert Chen',
                'role' => 'Business Administration',
                'image' => 'College/assets/img/person/person-m-7.webp',
                'linkedin_url' => '#',
                'twitter_url' => '#',
                'email' => 'robert.chen@example.com',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Dr. Emily Davis',
                'role' => 'Education',
                'image' => 'College/assets/img/person/person-f-9.webp',
                'linkedin_url' => '#',
                'twitter_url' => '#',
                'email' => 'emily.davis@example.com',
                'sort_order' => 4,
                'is_active' => true,
            ],
        ]);
    }
}
