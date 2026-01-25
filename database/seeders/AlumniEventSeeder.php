<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AlumniEvent;
use Illuminate\Support\Str;

class AlumniEventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            [
                'event_name' => 'Annual Alumni Reunion 2026',
                'description' => 'Join us for a night of networking and nostalgia at the Grand Hall.',
                'date' => now()->addMonths(2)->toDateTimeString(),
                'location' => 'Grand Hall, Campus Center',
                'registration_link' => 'https://example.com/register/reunion-2026',
                'featured_image' => 'storage/alumni/events/reunion.jpg',
            ],
            [
                'event_name' => 'Tech Career Workshop',
                'description' => 'Career guidance workshop for recent graduates interested in the tech industry.',
                'date' => now()->addWeeks(3)->toDateTimeString(),
                'location' => 'Virtual (Zoom)',
                'registration_link' => 'https://example.com/register/tech-workshop',
                'featured_image' => 'storage/alumni/events/workshop.jpg',
            ],
             [
                'event_name' => 'Alumni Sports Day',
                'description' => 'A fun day of sports and activities for alumni and their families.',
                'date' => now()->addMonths(5)->toDateTimeString(),
                'location' => 'Campus Sports Complex',
                'registration_link' => null,
                'featured_image' => 'storage/alumni/events/sports.jpg',
            ],
        ];

        foreach ($events as $event) {
            AlumniEvent::updateOrCreate(
                ['slug' => Str::slug($event['event_name'])],
                $event
            );
        }
    }
}
