<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $events = [
            [
                'title' => 'Annual Science Exhibition',
                'slug' => 'annual-science-exhibition',
                'category' => 'Academic',
                'description' => 'Join us for our annual science exhibition showcasing innovative student projects and scientific demonstrations. This event features interactive presentations, robotics competitions, and special lectures by renowned scientists.',
                'event_date' => '2024-05-15',
                'event_time' => '09:00 AM - 04:00 PM',
                'location' => 'Main Campus Auditorium',
                'participants' => '200+ Students',
                'image' => '/College/assets/img/education/events-5.webp',
                'registration_url' => '#',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Parent-Teacher Conference',
                'slug' => 'parent-teacher-conference',
                'category' => 'Academic',
                'description' => 'An opportunity for parents to meet with teachers and discuss their children\'s academic progress, achievements, and areas for improvement.',
                'event_date' => '2024-05-22',
                'event_time' => '02:00 PM - 06:00 PM',
                'location' => 'School Conference Center',
                'participants' => 'All Parents',
                'image' => '/College/assets/img/education/events-6.webp',
                'registration_url' => '#',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Annual Sports Tournament',
                'slug' => 'annual-sports-tournament',
                'category' => 'Sports',
                'description' => 'Competitive sports tournament featuring various athletic events including track and field, basketball, volleyball, and more. Open to all students.',
                'event_date' => '2024-06-05',
                'event_time' => '10:00 AM - 05:00 PM',
                'location' => 'Campus Sports Ground',
                'participants' => '150+ Athletes',
                'image' => '/College/assets/img/education/events-7.webp',
                'registration_url' => '#',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'Graduation Ceremony 2024',
                'slug' => 'graduation-ceremony-2024',
                'category' => 'Academic',
                'description' => 'Celebrate the achievements of our graduating class. This special ceremony honors students who have completed their studies and are ready to embark on their next journey.',
                'event_date' => '2024-06-12',
                'event_time' => '04:00 PM - 07:00 PM',
                'location' => 'University Grand Hall',
                'participants' => 'Graduating Students & Families',
                'image' => '/College/assets/img/education/events-8.webp',
                'registration_url' => '#',
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'title' => 'Summer Arts Festival',
                'slug' => 'summer-arts-festival',
                'category' => 'Arts & Culture',
                'description' => 'A vibrant celebration of creativity featuring student art exhibitions, musical performances, dance shows, and theatrical presentations.',
                'event_date' => '2024-06-20',
                'event_time' => '11:00 AM - 08:00 PM',
                'location' => 'Arts Center',
                'participants' => '100+ Artists',
                'image' => '/College/assets/img/education/events-9.webp',
                'registration_url' => '#',
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'title' => 'Mathematics Olympiad',
                'slug' => 'mathematics-olympiad',
                'category' => 'Academic',
                'description' => 'Competitive mathematics competition challenging students with complex problem-solving tasks and mathematical reasoning.',
                'event_date' => '2024-07-10',
                'event_time' => '09:00 AM - 12:00 PM',
                'location' => 'Room 203, East Wing',
                'participants' => '50+ Students',
                'image' => '/College/assets/img/education/events-1.webp',
                'registration_url' => '#',
                'is_active' => true,
                'sort_order' => 6,
            ],
        ];

        foreach ($events as $event) {
            Event::updateOrCreate(
                ['slug' => $event['slug']],
                $event
            );
        }
    }
}
