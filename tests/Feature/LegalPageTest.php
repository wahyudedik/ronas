<?php

namespace Tests\Feature;

use App\Models\LegalPage;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class LegalPageTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Setup permissions
        Permission::create(['name' => 'manage legal pages']);
        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo('manage legal pages');
    }

    public function test_public_can_view_published_legal_page()
    {
        $user = User::factory()->create();
        $page = LegalPage::create([
            'slug' => 'privacy',
            'title' => 'Privacy Policy',
            'content' => 'Content',
            'status' => 'published',
            'created_by' => $user->id,
            'published_at' => now(),
        ]);

        $response = $this->get(route('legal.show', 'privacy'));

        $response->assertStatus(200);
        $response->assertSee('Privacy Policy');
    }

    public function test_public_cannot_view_draft_legal_page()
    {
        $user = User::factory()->create();
        $page = LegalPage::create([
            'slug' => 'draft-page',
            'title' => 'Draft Page',
            'content' => 'Content',
            'status' => 'draft',
            'created_by' => $user->id,
        ]);

        $response = $this->get(route('legal.show', 'draft-page'));

        $response->assertStatus(404);
    }

    public function test_admin_can_create_legal_page()
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $response = $this->actingAs($admin)->post(route('admin.legal.pages.store'), [
            'title' => 'New Page',
            'slug' => 'new-page',
            'content' => 'New Content',
            'status' => 'published',
        ]);

        $response->assertRedirect(route('admin.legal.pages.index'));
        $this->assertDatabaseHas('legal_pages', ['slug' => 'new-page']);
        $this->assertDatabaseHas('audit_logs', ['action' => 'create']);
    }

    public function test_admin_can_update_legal_page_creating_new_version()
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $page = LegalPage::create([
            'slug' => 'update-page',
            'title' => 'Update Page',
            'content' => 'Old Content',
            'status' => 'published',
            'version' => 1,
            'created_by' => $admin->id,
        ]);

        $response = $this->actingAs($admin)->put(route('admin.legal.pages.update', $page), [
            'title' => 'Update Page',
            'slug' => 'update-page',
            'content' => 'New Content',
            'status' => 'published',
        ]);

        $response->assertRedirect(route('admin.legal.pages.index'));
        
        $this->assertDatabaseHas('legal_pages', [
            'id' => $page->id,
            'content' => 'New Content',
            'version' => 2
        ]);

        $this->assertDatabaseHas('legal_page_versions', [
            'legal_page_id' => $page->id,
            'version' => 2,
            'content' => 'New Content'
        ]);
    }
}
