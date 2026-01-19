<?php

namespace Database\Seeders;

use App\Models\LandingEventItem;
use App\Models\LandingHero;
use App\Models\LandingNewsItem;
use App\Models\LandingProgram;
use App\Models\LandingSection;
use App\Models\LandingStat;
use App\Models\LandingStudentLifeItem;
use App\Models\LandingTestimonial;
use Illuminate\Database\Seeder;

class LandingPageSeeder extends Seeder
{
    public function run(): void
    {
        LandingSection::query()->delete();
        LandingHero::query()->delete();
        LandingStat::query()->delete();
        LandingProgram::query()->delete();
        LandingStudentLifeItem::query()->delete();
        LandingTestimonial::query()->delete();
        LandingNewsItem::query()->delete();
        LandingEventItem::query()->delete();

        LandingSection::insert([
            [
                'key' => 'stats',
                'title' => 'Transforming Lives Through Quality Education',
                'subtitle' => 'Success metrics that reflect our commitment to excellence.',
                'description' => 'Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'key' => 'programs',
                'title' => 'Featured Programs',
                'subtitle' => 'Discover the programs that shape future leaders.',
                'description' => null,
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'key' => 'student_life',
                'title' => 'Students Life',
                'subtitle' => 'Experience a vibrant campus community.',
                'description' => null,
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'key' => 'testimonials',
                'title' => 'Testimonials',
                'subtitle' => 'Hear from our students and alumni.',
                'description' => null,
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'key' => 'news',
                'title' => 'Recent News',
                'subtitle' => 'Latest stories from our campus.',
                'description' => null,
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'key' => 'events',
                'title' => 'Events',
                'subtitle' => 'Join our upcoming events and workshops.',
                'description' => null,
                'sort_order' => 6,
                'is_active' => true,
            ],
        ]);

        LandingHero::create([
            'title' => 'Inspiring Excellence Through Education',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas eget lacus id tortor facilisis tincidunt.',
            'primary_label' => 'Start Your Journey',
            'primary_url' => '#',
            'secondary_label' => 'Virtual Tour',
            'secondary_url' => '#',
            'image' => 'College/assets/img/education/showcase-6.webp',
            'badge_text' => 'Accredited Excellence',
            'badge_icon' => 'bi bi-patch-check-fill',
            'stat_one_value' => '96%',
            'stat_one_label' => 'Employment Rate',
            'stat_two_value' => '12:1',
            'stat_two_label' => 'Student-Teacher Ratio',
            'stat_three_value' => '50+',
            'stat_three_label' => 'Programs',
            'event_day' => '15',
            'event_month' => 'NOV',
            'event_title' => 'Spring Semester Open House',
            'event_description' => 'Join us to explore campus facilities, meet our faculty, and learn about scholarship opportunities.',
            'event_button_label' => 'RSVP Now',
            'event_button_url' => '#',
            'event_countdown_text' => 'Starts in 3 weeks',
            'is_active' => true,
        ]);

        LandingStat::insert([
            [
                'label' => 'Success Rate',
                'description' => 'Alumni employment within 6 months',
                'value' => '87',
                'suffix' => '%',
                'icon_class' => 'bi bi-mortarboard-fill',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'label' => 'Campus Locations',
                'description' => 'Across the country serving students',
                'value' => '8',
                'suffix' => '',
                'icon_class' => 'bi bi-building',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'label' => 'Awards Received',
                'description' => 'Recognition for educational excellence',
                'value' => '250',
                'suffix' => '+',
                'icon_class' => 'bi bi-trophy-fill',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'label' => 'Countries Represented',
                'description' => 'Diverse international student body',
                'value' => '65',
                'suffix' => '+',
                'icon_class' => 'bi bi-globe',
                'sort_order' => 4,
                'is_active' => true,
            ],
        ]);

        LandingProgram::create([
            'title' => 'Engineering & Technology',
            'description' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.',
            'duration_text' => 'Duration: 4 Years',
            'degree_text' => "Bachelor's Degree",
            'image' => 'College/assets/img/education/campus-3.webp',
            'badge_text' => 'Popular',
            'meta_one' => '450+ Students',
            'meta_two' => '95% Success Rate',
            'is_featured' => true,
            'sort_order' => 1,
            'is_active' => true,
        ]);

        LandingProgram::insert([
            [
                'title' => 'Business Management',
                'description' => 'Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit.',
                'duration_text' => '3 Years',
                'degree_text' => "Master's Degree",
                'image' => 'College/assets/img/education/education-4.webp',
                'badge_text' => null,
                'meta_one' => null,
                'meta_two' => null,
                'is_featured' => false,
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Digital Marketing',
                'description' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium.',
                'duration_text' => '2 Years',
                'degree_text' => 'Certificate',
                'image' => 'College/assets/img/education/education-6.webp',
                'badge_text' => null,
                'meta_one' => null,
                'meta_two' => null,
                'is_featured' => false,
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Health Sciences',
                'description' => 'Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe.',
                'duration_text' => '5 Years',
                'degree_text' => "Bachelor's Degree",
                'image' => 'College/assets/img/education/education-8.webp',
                'badge_text' => null,
                'meta_one' => null,
                'meta_two' => null,
                'is_featured' => false,
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'title' => 'Creative Arts',
                'description' => 'Et harum quidem rerum facilis est et expedita distinctio nam libero tempore.',
                'duration_text' => '3 Years',
                'degree_text' => "Bachelor's Degree",
                'image' => 'College/assets/img/education/education-10.webp',
                'badge_text' => null,
                'meta_one' => null,
                'meta_two' => null,
                'is_featured' => false,
                'sort_order' => 5,
                'is_active' => true,
            ],
        ]);

        LandingStudentLifeItem::insert([
            [
                'title' => 'Student Organizations',
                'description' => 'Ut enim ad minim veniam quis nostrud exercitation ullamco laboris nisi ut aliquip.',
                'image' => 'College/assets/img/education/activities-2.webp',
                'link_label' => 'Learn More',
                'link_url' => '#',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Research Projects',
                'description' => 'Sed ut perspiciatis unde omnis natus error.',
                'image' => 'College/assets/img/education/activities-6.webp',
                'link_label' => 'Explore',
                'link_url' => '#',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Community Service',
                'description' => 'At vero eos et accusamus et iusto odio.',
                'image' => 'College/assets/img/education/activities-1.webp',
                'link_label' => 'Join',
                'link_url' => '#',
                'sort_order' => 3,
                'is_active' => true,
            ],
        ]);

        LandingTestimonial::insert([
            [
                'name' => 'Jessica Martinez',
                'role' => 'UX Designer',
                'quote' => 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                'image' => 'College/assets/img/person/person-f-12.webp',
                'rating' => 5,
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'David Rodriguez',
                'role' => 'Software Engineer',
                'quote' => 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.',
                'image' => 'College/assets/img/person/person-m-8.webp',
                'rating' => 5,
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Amanda Wilson',
                'role' => 'Creative Director',
                'quote' => 'Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore.',
                'image' => 'College/assets/img/person/person-f-6.webp',
                'rating' => 5,
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Ryan Thompson',
                'role' => 'Business Analyst',
                'quote' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque.',
                'image' => 'College/assets/img/person/person-m-12.webp',
                'rating' => 5,
                'sort_order' => 4,
                'is_active' => true,
            ],
        ]);

        LandingNewsItem::insert([
            [
                'title' => 'Sed ut perspiciatis unde omnis',
                'category' => 'Design',
                'excerpt' => 'Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit.',
                'author_name' => 'Lina Chen',
                'author_image' => 'College/assets/img/person/person-f-12.webp',
                'published_at' => '2025-03-15',
                'image' => 'College/assets/img/blog/blog-post-1.webp',
                'link_url' => '#',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'At vero eos et accusamus',
                'category' => 'Product',
                'excerpt' => 'Et harum quidem rerum facilis est et expedita distinctio nam libero tempore.',
                'author_name' => 'Sofia Rodriguez',
                'author_image' => 'College/assets/img/person/person-f-13.webp',
                'published_at' => '2025-04-22',
                'image' => 'College/assets/img/blog/blog-post-2.webp',
                'link_url' => '#',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Temporibus autem quibusdam',
                'category' => 'Software Engineering',
                'excerpt' => 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis.',
                'author_name' => 'Lucas Thompson',
                'author_image' => 'College/assets/img/person/person-m-10.webp',
                'published_at' => '2025-05-08',
                'image' => 'College/assets/img/blog/blog-post-3.webp',
                'link_url' => '#',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Nam libero tempore soluta',
                'category' => 'Creative',
                'excerpt' => 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia.',
                'author_name' => 'Emma Patel',
                'author_image' => 'College/assets/img/person/person-f-14.webp',
                'published_at' => '2025-06-30',
                'image' => 'College/assets/img/blog/blog-post-4.webp',
                'link_url' => '#',
                'sort_order' => 4,
                'is_active' => true,
            ],
        ]);

        LandingEventItem::insert([
            [
                'title' => 'Advanced Mathematics Workshop',
                'category' => 'Academic',
                'time_text' => '2:00 PM',
                'date_day' => '18',
                'date_month' => 'MAR',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt.',
                'location' => 'Room 205, Science Building',
                'participants' => '25 Participants',
                'image' => 'College/assets/img/education/events-3.webp',
                'link_url' => '#',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Inter-School Basketball Championship',
                'category' => 'Sports',
                'time_text' => '9:00 AM',
                'date_day' => '05',
                'date_month' => 'APR',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipiscing elit sed eiusmod tempor incididunt.',
                'location' => 'Sports Complex Gym',
                'participants' => '8 Teams',
                'image' => 'College/assets/img/education/events-5.webp',
                'link_url' => '#',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Student Art Exhibition Opening',
                'category' => 'Arts',
                'time_text' => '6:00 PM',
                'date_day' => '12',
                'date_month' => 'APR',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt.',
                'location' => 'Art Gallery, First Floor',
                'participants' => 'Open to All',
                'image' => 'College/assets/img/education/events-7.webp',
                'link_url' => '#',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Annual Science Fair Competition',
                'category' => 'Academic',
                'time_text' => '10:00 AM',
                'date_day' => '03',
                'date_month' => 'MAY',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt.',
                'location' => 'Main Auditorium Hall',
                'participants' => '45 Projects',
                'image' => 'College/assets/img/education/events-2.webp',
                'link_url' => '#',
                'sort_order' => 4,
                'is_active' => true,
            ],
        ]);
    }
}
