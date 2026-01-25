<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\EventCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $events = [
            [
                'title' => 'Annual Science Exhibition',
                'slug' => 'annual-science-exhibition',
                'category_name' => 'Academic',
                'description' => 'Join us for our annual science exhibition showcasing innovative student projects and scientific demonstrations. This event features interactive presentations, robotics competitions, and special lectures by renowned scientists.',
                'event_date' => '2024-05-15',
                'start_time_str' => '09:00:00',
                'end_time_str' => '16:00:00',
                'venue' => 'Main Campus Auditorium',
                'image' => '/College/assets/img/education/events-5.webp',
                'registration_url' => '#',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Parent-Teacher Conference',
                'slug' => 'parent-teacher-conference',
                'category_name' => 'Academic',
                'description' => 'An opportunity for parents to meet with teachers and discuss their children\'s academic progress, achievements, and areas for improvement.',
                'event_date' => '2024-05-22',
                'start_time_str' => '14:00:00',
                'end_time_str' => '18:00:00',
                'venue' => 'School Conference Center',
                'image' => '/College/assets/img/education/events-6.webp',
                'registration_url' => '#',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Annual Sports Tournament',
                'slug' => 'annual-sports-tournament',
                'category_name' => 'Sports',
                'description' => 'Competitive sports tournament featuring various athletic events including track and field, basketball, volleyball, and more. Open to all students.',
                'event_date' => '2024-06-05',
                'start_time_str' => '10:00:00',
                'end_time_str' => '17:00:00',
                'venue' => 'Campus Sports Ground',
                'image' => '/College/assets/img/education/events-7.webp',
                'registration_url' => '#',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'Graduation Ceremony 2024',
                'slug' => 'graduation-ceremony-2024',
                'category_name' => 'Academic',
                'description' => 'Celebrate the achievements of our graduating class. This special ceremony honors students who have completed their studies and are ready to embark on their next journey.',
                'event_date' => '2024-06-12',
                'start_time_str' => '16:00:00',
                'end_time_str' => '19:00:00',
                'venue' => 'University Grand Hall',
                'image' => '/College/assets/img/education/events-8.webp',
                'registration_url' => '#',
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'title' => 'Summer Arts Festival',
                'slug' => 'summer-arts-festival',
                'category_name' => 'Arts & Culture',
                'description' => 'A vibrant celebration of creativity featuring student art exhibitions, musical performances, dance shows, and theatrical presentations.',
                'event_date' => '2024-06-20',
                'start_time_str' => '11:00:00',
                'end_time_str' => '20:00:00',
                'venue' => 'Arts Center',
                'image' => '/College/assets/img/education/events-9.webp',
                'registration_url' => '#',
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'title' => 'Mathematics Olympiad',
                'slug' => 'mathematics-olympiad',
                'category_name' => 'Academic',
                'description' => 'Competitive mathematics competition challenging students with complex problem-solving tasks and mathematical reasoning.',
                'event_date' => '2024-07-10',
                'start_time_str' => '09:00:00',
                'end_time_str' => '12:00:00',
                'venue' => 'Room 203, East Wing',
                'image' => '/College/assets/img/education/events-1.webp',
                'registration_url' => '#',
                'is_active' => true,
                'sort_order' => 6,
            ],
        ];

        foreach ($events as $event) {
            $category = EventCategory::where('name', $event['category_name'])->first();
            $eventDate = Carbon::parse($event['event_date']);

            // Determine status based on date
            $status = 'upcoming';
            if ($eventDate->isPast()) {
                $status = 'past';
            }

            Event::updateOrCreate(
                ['slug' => $event['slug']],
                [
                    'title' => $event['title'],
                    'slug' => $event['slug'],
                    'category_id' => $category ? $category->id : null,
                    'description' => $event['description'],
                    'start_date' => $eventDate,
                    'end_date' => $eventDate, // One day event
                    'start_time' => $event['start_time_str'],
                    'end_time' => $event['end_time_str'],
                    'venue' => $event['venue'],
                    'image' => $event['image'],
                    'registration_url' => $event['registration_url'],
                    'is_active' => $event['is_active'],
                    'sort_order' => $event['sort_order'],
                    'status' => $status,
                ]
            );
        }
    }
}
