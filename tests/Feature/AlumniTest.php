<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\AlumniStory;
use App\Models\AlumniEvent;
use App\Models\DonationCampaign;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AlumniTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_can_view_alumni_page(): void
    {
        $response = $this->get(route('college.alumni.index'));
        $response->assertStatus(200);
    }

    public function test_user_can_submit_story(): void
    {
        Storage::fake('public');
        
        $user = User::factory()->create();
        
        $response = $this->actingAs($user)->post(route('college.alumni.submit-story'), [
            'title' => 'My Success Story',
            'alumni_name' => 'Test User',
            'graduation_year' => 2020,
            'content' => 'This is my story content.',
            'featured_image' => UploadedFile::fake()->image('story.jpg')
        ]);

        $response->assertRedirect(route('college.alumni.index'));
        $this->assertDatabaseHas('alumni_stories', [
            'title' => 'My Success Story',
            'status' => 'pending',
            'user_id' => $user->id
        ]);
    }

    public function test_admin_can_approve_story(): void
    {
        $admin = User::factory()->create(); // In a real app, this user needs admin permissions/role
        
        // Mocking admin permission check if necessary, or just assuming 'auth' middleware for now as per implementation
        // But the route is protected by 'auth' middleware group in web.php
        
        $story = AlumniStory::create([
            'title' => 'Pending Story',
            'slug' => 'pending-story',
            'content' => 'Content',
            'alumni_name' => 'Alumni',
            'graduation_year' => 2021,
            'status' => 'pending'
        ]);

        $response = $this->actingAs($admin)->put(route('admin.alumni.stories.update', $story), [
            'title' => 'Pending Story',
            'alumni_name' => 'Alumni',
            'graduation_year' => 2021,
            'content' => 'Content',
            'status' => 'approved'
        ]);

        $response->assertRedirect(route('admin.alumni.stories.index'));
        $this->assertDatabaseHas('alumni_stories', [
            'id' => $story->id,
            'status' => 'approved'
        ]);
    }

    public function test_public_can_view_active_events(): void
    {
        AlumniEvent::create([
            'event_name' => 'Active Event',
            'slug' => 'active-event',
            'date' => now()->addDay(),
            'is_active' => true
        ]);

        AlumniEvent::create([
            'event_name' => 'Inactive Event',
            'slug' => 'inactive-event',
            'date' => now()->addDay(),
            'is_active' => false
        ]);

        $response = $this->get(route('college.alumni.events'));
        $response->assertStatus(200);
        $response->assertSee('Active Event');
        $response->assertDontSee('Inactive Event');
    }

    public function test_donation_process(): void
    {
        $campaign = DonationCampaign::create([
            'campaign_name' => 'Test Campaign',
            'slug' => 'test-campaign',
            'target_amount' => 1000,
            'current_amount' => 0,
            'is_active' => true,
            'deadline' => now()->addMonth()
        ]);

        $response = $this->post(route('college.alumni.process-donation'), [
            'campaign_id' => $campaign->id,
            'amount' => 100,
            'donor_name' => 'Donor',
            'email' => 'donor@example.com',
            'payment_method' => 'Credit Card'
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('donation_campaigns', [
            'id' => $campaign->id,
            'current_amount' => 100
        ]);
    }
}
