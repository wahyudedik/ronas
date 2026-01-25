<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\EventCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventTest extends TestCase
{
    use RefreshDatabase;
    public function test_public_can_view_event_list(): void
    {
        $response = $this->get(route('college.events'));
        $response->assertStatus(200);
    }

    public function test_public_can_view_event_detail(): void
    {
        $category = EventCategory::firstOrCreate(['name' => 'Test Event Cat', 'slug' => 'test-event-cat']);
        $event = Event::create([
            'title' => 'Test Event Detail',
            'slug' => 'test-event-detail-' . time(),
            'category_id' => $category->id,
            'description' => 'Description',
            'status' => 'upcoming',
            'is_active' => true,
            'start_date' => now()->addDays(5),
        ]);

        $response = $this->get(route('college.events.show', $event));
        $response->assertStatus(200);
        $response->assertSee('Test Event Detail');

        $event->delete();
    }
}
