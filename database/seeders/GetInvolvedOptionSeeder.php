<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GetInvolvedOption;

class GetInvolvedOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $options = [
            [
                'title' => 'Become a Mentor',
                'description' => 'Guide current students in their career paths and share your industry experience.',
                'type' => 'Mentorship',
                'requirements' => 'Minimum 3 years of professional experience.',
                'contact_info' => 'mentorship@alumni.com',
            ],
            [
                'title' => 'Guest Speaker',
                'description' => 'Share your knowledge and insights as a guest speaker in classes or seminars.',
                'type' => 'Volunteering',
                'requirements' => 'Expertise in a specific field.',
                'contact_info' => 'events@alumni.com',
            ],
            [
                'title' => 'Career Fair Volunteer',
                'description' => 'Help organize and run our annual career fair.',
                'type' => 'Volunteering',
                'requirements' => 'Available on weekends.',
                'contact_info' => 'careers@alumni.com',
            ],
        ];

        foreach ($options as $option) {
            GetInvolvedOption::updateOrCreate(
                ['title' => $option['title']],
                $option
            );
        }
    }
}
