<?php

namespace Database\Seeders;

use App\Models\News;
use App\Models\NewsCategory;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('email', 'admin@gmail.com')->first();
        if (!$admin) {
            // Fallback if admin not found (should run after UserSeeder)
            $admin = User::first();
        }
        $adminId = $admin ? $admin->id : null;

        $newsItems = [
            [
                'title' => 'Optimizing Strategic Initiatives Through Cross-Functional Collaboration',
                'slug' => 'optimizing-strategic-initiatives-through-cross-functional-collaboration',
                'category_name' => 'Politics',
                'excerpt' => 'Leveraging core competencies to drive sustainable growth and maximize stakeholder value through innovative solutions and market-driven approaches.',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.',
                'image' => '/College/assets/img/blog/blog-hero-9.webp',
                'published_at' => '2024-02-15',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Implementing Agile Methodologies for Enhanced Business Performance',
                'slug' => 'implementing-agile-methodologies-for-enhanced-business-performance',
                'category_name' => 'Politics',
                'excerpt' => 'Exploring how agile frameworks can transform organizational efficiency and drive innovation in modern business environments.',
                'content' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.',
                'image' => '/College/assets/img/blog/blog-post-1.webp',
                'published_at' => '2024-03-21',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Streamlining Operations Through Digital Transformation Solutions',
                'slug' => 'streamlining-operations-through-digital-transformation-solutions',
                'category_name' => 'Business',
                'excerpt' => 'Discover how digital transformation is reshaping business operations and creating new opportunities for growth.',
                'content' => 'Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.',
                'image' => '/College/assets/img/blog/blog-post-2.webp',
                'published_at' => '2024-01-30',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'Maximizing ROI Through Strategic Resource Allocation',
                'slug' => 'maximizing-roi-through-strategic-resource-allocation',
                'category_name' => 'Science',
                'excerpt' => 'Understanding the principles of effective resource management and their impact on organizational success.',
                'content' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident.',
                'image' => '/College/assets/img/blog/blog-post-square-1.webp',
                'published_at' => '2024-04-10',
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'title' => 'Leveraging Big Data Analytics for Market Intelligence',
                'slug' => 'leveraging-big-data-analytics-for-market-intelligence',
                'category_name' => 'Technology',
                'excerpt' => 'How data analytics is revolutionizing market research and business decision-making processes.',
                'content' => 'Similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio.',
                'image' => '/College/assets/img/blog/blog-post-square-2.webp',
                'published_at' => '2024-05-05',
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'title' => 'Enhancing Customer Experience Through Digital Innovation',
                'slug' => 'enhancing-customer-experience-through-digital-innovation',
                'category_name' => 'Innovation',
                'excerpt' => 'Exploring innovative approaches to customer engagement and satisfaction in the digital age.',
                'content' => 'Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est.',
                'image' => '/College/assets/img/blog/blog-post-square-3.webp',
                'published_at' => '2024-06-12',
                'is_active' => true,
                'sort_order' => 6,
            ],
        ];

        foreach ($newsItems as $item) {
            $category = NewsCategory::where('name', $item['category_name'])->first();

            News::updateOrCreate(
                ['slug' => $item['slug']],
                [
                    'title' => $item['title'],
                    'slug' => $item['slug'],
                    'category_id' => $category ? $category->id : null,
                    'excerpt' => $item['excerpt'],
                    'content' => $item['content'],
                    'author_id' => $adminId,
                    'image' => $item['image'],
                    'published_at' => $item['published_at'],
                    'is_active' => $item['is_active'],
                    'sort_order' => $item['sort_order'],
                    'status' => 'published',
                ]
            );
        }
    }
}
