<?php

namespace Database\Seeders;

use App\Models\AboutCoreValue;
use App\Models\AboutHistory;
use App\Models\AboutHistoryMilestone;
use App\Models\AboutLeadershipHighlight;
use App\Models\AboutLeadershipMember;
use App\Models\AboutLeadershipSection;
use App\Models\AboutMissionVision;
use Illuminate\Database\Seeder;

class AboutPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $history = AboutHistory::updateOrCreate(
            ['title' => 'Our Story'],
            [
                'heading' => 'Educating Minds, Inspiring Hearts',
                'description' => 'SMKS Roudlotun Nasyiin is committed to nurturing talent, character, and leadership through practical education and community values.',
                'sort_order' => 1,
                'is_active' => true,
            ]
        );

        $milestones = [
            ['year' => '1998', 'description' => 'School founded with a focus on vocational excellence.'],
            ['year' => '2008', 'description' => 'Expanded programs and student activities.'],
            ['year' => '2016', 'description' => 'Upgraded facilities and industry partnerships.'],
            ['year' => '2024', 'description' => 'Strengthened digital learning and innovation.'],
        ];

        foreach ($milestones as $index => $milestone) {
            AboutHistoryMilestone::updateOrCreate(
                [
                    'about_history_id' => $history->id,
                    'year' => $milestone['year'],
                ],
                [
                    'description' => $milestone['description'],
                    'sort_order' => $index + 1,
                    'is_active' => true,
                ]
            );
        }

        AboutMissionVision::updateOrCreate(
            ['type' => 'mission', 'title' => 'Our Mission'],
            [
                'description' => 'Provide quality vocational education, build character, and prepare students for real-world careers.',
                'sort_order' => 1,
                'is_active' => true,
            ]
        );

        AboutMissionVision::updateOrCreate(
            ['type' => 'vision', 'title' => 'Our Vision'],
            [
                'description' => 'Become a leading vocational school that shapes skilled, ethical, and innovative graduates.',
                'sort_order' => 2,
                'is_active' => true,
            ]
        );

        $coreValues = [
            ['icon_class' => 'bi bi-book', 'title' => 'Academic Excellence', 'description' => 'Commitment to high-quality learning.'],
            ['icon_class' => 'bi bi-people', 'title' => 'Community Engagement', 'description' => 'Grow together with society.'],
            ['icon_class' => 'bi bi-lightbulb', 'title' => 'Innovation', 'description' => 'Encourage creativity and problem solving.'],
            ['icon_class' => 'bi bi-globe', 'title' => 'Global Perspective', 'description' => 'Prepare students for a global future.'],
        ];

        foreach ($coreValues as $index => $value) {
            AboutCoreValue::updateOrCreate(
                ['title' => $value['title']],
                [
                    'icon_class' => $value['icon_class'],
                    'description' => $value['description'],
                    'sort_order' => $index + 1,
                    'is_active' => true,
                ]
            );
        }

        $leadershipSection = AboutLeadershipSection::updateOrCreate(
            ['title' => 'Inspiring Leaders Shaping Tomorrow\'s Generation'],
            [
                'subtitle' => 'Administration & Leadership',
                'description' => 'Our leadership team focuses on excellence, student success, and innovation.',
                'experience_years' => '20+',
                'experience_text' => 'Years of Educational Excellence',
                'sort_order' => 1,
                'is_active' => true,
            ]
        );

        $highlights = [
            ['icon_class' => 'bi bi-mortarboard-fill', 'title' => 'Expert Faculty', 'description' => 'Skilled teachers with industry experience.'],
            ['icon_class' => 'bi bi-graph-up-arrow', 'title' => 'Academic Growth', 'description' => 'Continuous improvement and achievement.'],
        ];

        foreach ($highlights as $index => $highlight) {
            AboutLeadershipHighlight::updateOrCreate(
                [
                    'about_leadership_section_id' => $leadershipSection->id,
                    'title' => $highlight['title'],
                ],
                [
                    'icon_class' => $highlight['icon_class'],
                    'description' => $highlight['description'],
                    'sort_order' => $index + 1,
                    'is_active' => true,
                ]
            );
        }

        $members = [
            ['name' => 'Ahmad Fauzi', 'role' => 'Principal', 'bio' => 'Dedicated to educational leadership and student success.'],
            ['name' => 'Siti Nurhayati', 'role' => 'Vice Principal', 'bio' => 'Focused on curriculum development and quality assurance.'],
            ['name' => 'Budi Santoso', 'role' => 'Academic Dean', 'bio' => 'Leads academic excellence and innovation.'],
            ['name' => 'Dewi Lestari', 'role' => 'Student Affairs', 'bio' => 'Supports student well-being and activities.'],
        ];

        foreach ($members as $index => $member) {
            AboutLeadershipMember::updateOrCreate(
                [
                    'about_leadership_section_id' => $leadershipSection->id,
                    'name' => $member['name'],
                ],
                [
                    'role' => $member['role'],
                    'bio' => $member['bio'],
                    'sort_order' => $index + 1,
                    'is_active' => true,
                    'social_links' => null,
                ]
            );
        }
    }
}
