<?php

namespace Tests\Feature;

use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NewsTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_can_view_news_list(): void
    {
        $response = $this->get(route('college.news'));
        $response->assertStatus(200);
    }

    public function test_public_can_view_news_detail(): void
    {
        $category = NewsCategory::firstOrCreate(['name' => 'Test Cat', 'slug' => 'test-cat']);
        $news = News::create([
            'title' => 'Test News Detail',
            'slug' => 'test-news-detail-' . time(),
            'category_id' => $category->id,
            'content' => 'Content',
            'status' => 'published',
            'is_active' => true,
            'published_at' => now(),
        ]);

        $response = $this->get(route('college.news.show', $news));
        $response->assertStatus(200);
        $response->assertSee('Test News Detail');

        $news->delete();
    }
}
