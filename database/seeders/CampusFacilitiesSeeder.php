<?php

namespace Database\Seeders;

use App\Models\CampusFacilityCategory;
use App\Models\CampusFacilityItem;
use App\Models\CampusHighlight;
use App\Models\CampusMapAction;
use App\Models\CampusMapCategory;
use App\Models\CampusMapSetting;
use App\Models\CampusVirtualTour;
use App\Models\CampusVirtualTourFeature;
use Illuminate\Database\Seeder;

class CampusFacilitiesSeeder extends Seeder
{
    public function run(): void
    {
        CampusFacilityItem::query()->delete();
        CampusFacilityCategory::query()->delete();
        CampusVirtualTourFeature::query()->delete();
        CampusVirtualTour::query()->delete();
        CampusHighlight::query()->delete();
        CampusMapAction::query()->delete();
        CampusMapCategory::query()->delete();
        CampusMapSetting::query()->delete();

        $categories = CampusFacilityCategory::insert([
            [
                'name' => 'Academic Facilities',
                'theme' => 'academic',
                'icon_class' => 'bi bi-book',
                'image' => 'College/assets/img/education/campus-7.webp',
                'button_label' => 'Explore Academic',
                'button_url' => '#',
                'description' => 'Modern learning spaces and research centers for future leaders.',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Sports Complex',
                'theme' => 'sports',
                'icon_class' => 'bi bi-trophy',
                'image' => 'College/assets/img/education/campus-8.webp',
                'button_label' => 'Explore Sports',
                'button_url' => '#',
                'description' => 'Facilities designed for training, competition, and wellness.',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Living Spaces',
                'theme' => 'residence',
                'icon_class' => 'bi bi-house-heart',
                'image' => 'College/assets/img/education/campus-9.webp',
                'button_label' => 'Explore Housing',
                'button_url' => '#',
                'description' => 'Comfortable residential options with community amenities.',
                'sort_order' => 3,
                'is_active' => true,
            ],
        ]);

        $categoryIds = CampusFacilityCategory::query()
            ->orderBy('sort_order')
            ->pluck('id', 'name');

        $items = [
            'Academic Facilities' => [
                'Advanced Research Labs',
                'Smart Classrooms',
                'Digital Library',
                'Study Lounges',
            ],
            'Sports Complex' => [
                'Olympic Pool',
                'Gymnasium',
                'Tennis Courts',
                'Fitness Center',
            ],
            'Living Spaces' => [
                'Modern Dormitories',
                'Common Areas',
                'Dining Halls',
                'Recreation Rooms',
            ],
        ];

        foreach ($items as $categoryName => $labels) {
            $categoryId = $categoryIds[$categoryName] ?? null;
            if (! $categoryId) {
                continue;
            }
            foreach ($labels as $index => $label) {
                CampusFacilityItem::create([
                    'category_id' => $categoryId,
                    'label' => $label,
                    'icon_class' => 'bi bi-check2-circle',
                    'sort_order' => $index + 1,
                    'is_active' => true,
                ]);
            }
        }

        $virtualTour = CampusVirtualTour::create([
            'title' => 'Take a Virtual Campus Tour',
            'description' => 'Experience our campus with an interactive walkthrough and discover key locations.',
            'primary_label' => 'Start Virtual Tour',
            'primary_url' => '#',
            'secondary_label' => 'Schedule Visit',
            'secondary_url' => '#',
            'video_url' => 'College/assets/img/education/video-5.mp4',
            'badge_text' => 'Campus Tour',
            'is_active' => true,
        ]);

        CampusVirtualTourFeature::insert([
            [
                'campus_virtual_tour_id' => $virtualTour->id,
                'title' => '360° Views',
                'description' => 'Immersive campus experience',
                'icon_class' => 'bi bi-binoculars',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'campus_virtual_tour_id' => $virtualTour->id,
                'title' => 'Interactive Map',
                'description' => 'Navigate with ease',
                'icon_class' => 'bi bi-map',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'campus_virtual_tour_id' => $virtualTour->id,
                'title' => 'Detailed Info',
                'description' => 'Learn about each facility',
                'icon_class' => 'bi bi-info-circle',
                'sort_order' => 3,
                'is_active' => true,
            ],
        ]);

        CampusHighlight::insert([
            [
                'title' => 'Central Library',
                'category_label' => 'Academic',
                'description' => 'A comprehensive collection of resources and study areas.',
                'image' => 'College/assets/img/education/campus-10.webp',
                'stat_one_icon' => 'bi bi-book',
                'stat_one_label' => '500K+ Books',
                'stat_two_icon' => 'bi bi-wifi',
                'stat_two_label' => 'High-Speed WiFi',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Innovation Hub',
                'category_label' => 'Research',
                'description' => 'Collaborative space for creativity and experimentation.',
                'image' => 'College/assets/img/education/campus-11.webp',
                'stat_one_icon' => 'bi bi-cpu',
                'stat_one_label' => 'AI Labs',
                'stat_two_icon' => 'bi bi-gear',
                'stat_two_label' => 'Maker Space',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Student Center',
                'category_label' => 'Community',
                'description' => 'The heart of student life and campus events.',
                'image' => 'College/assets/img/education/campus-1.webp',
                'stat_one_icon' => 'bi bi-cup-hot',
                'stat_one_label' => 'Food Court',
                'stat_two_icon' => 'bi bi-controller',
                'stat_two_label' => 'Game Lounge',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Wellness Center',
                'category_label' => 'Wellness',
                'description' => 'Supporting healthy minds and bodies.',
                'image' => 'College/assets/img/education/campus-2.webp',
                'stat_one_icon' => 'bi bi-heart-pulse',
                'stat_one_label' => 'Health Services',
                'stat_two_icon' => 'bi bi-activity',
                'stat_two_label' => 'Fitness Classes',
                'sort_order' => 4,
                'is_active' => true,
            ],
        ]);

        CampusMapSetting::create([
            'title' => 'Navigate Our Campus',
            'description' => 'Explore our comprehensive campus map to find buildings, parking areas, and important facilities.',
            'embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.215482929933!2d-73.95999542349116!3d40.80709487138641!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c2f7a01fb08965%3A0x1234567890abcdef!2sColumbia%20University!5e0!3m2!1sen!2sus!4v1234567890123!5m2!1sen!2sus',
            'location_title' => 'Main Campus',
            'location_address' => '116th St & Broadway, New York',
            'stat_one_icon' => 'bi bi-geo-alt',
            'stat_one_label' => '32 Acres',
            'stat_two_icon' => 'bi bi-building',
            'stat_two_label' => '17 Buildings',
            'is_active' => true,
        ]);

        CampusMapCategory::insert([
            [
                'name' => 'All Locations',
                'key' => 'all',
                'icon_class' => 'bi bi-grid',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Academic',
                'key' => 'academic',
                'icon_class' => 'bi bi-book',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Dining',
                'key' => 'dining',
                'icon_class' => 'bi bi-cup-hot',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Parking',
                'key' => 'parking',
                'icon_class' => 'bi bi-car-front',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Recreation',
                'key' => 'recreation',
                'icon_class' => 'bi bi-activity',
                'sort_order' => 5,
                'is_active' => true,
            ],
        ]);

        CampusMapAction::insert([
            [
                'label' => 'Download Campus Map',
                'url' => '#',
                'icon_class' => 'bi bi-download',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'label' => 'Campus Shuttle Info',
                'url' => '#',
                'icon_class' => 'bi bi-phone',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'label' => 'Parking Information',
                'url' => '#',
                'icon_class' => 'bi bi-car-front',
                'sort_order' => 3,
                'is_active' => true,
            ],
        ]);
    }
}
