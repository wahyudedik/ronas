<?php

namespace Database\Seeders;

use App\Models\LandingStudentLifeItem;
use App\Models\StudentLifeSectionSetting;
use Illuminate\Database\Seeder;

class StudentLifePageSeeder extends Seeder
{
    public function run(): void
    {
        StudentLifeSectionSetting::query()->delete();
        LandingStudentLifeItem::query()->delete();

        StudentLifeSectionSetting::insert([
            [
                'key' => 'landing',
                'title' => 'Students Life',
                'subtitle' => 'Experience a vibrant campus community.',
                'is_active' => true,
            ],
            [
                'key' => 'organizations',
                'title' => 'Organisasi & Klub Mahasiswa',
                'subtitle' => 'Temukan komunitas yang sesuai dengan minatmu.',
                'is_active' => true,
            ],
            [
                'key' => 'athletics',
                'title' => 'Atletik & Rekreasi',
                'subtitle' => 'Kegiatan olahraga untuk kebugaran dan prestasi.',
                'is_active' => true,
            ],
            [
                'key' => 'facilities',
                'title' => 'Fasilitas Kampus',
                'subtitle' => 'Fasilitas lengkap untuk menunjang aktivitas mahasiswa.',
                'is_active' => true,
            ],
            [
                'key' => 'support_services',
                'title' => 'Layanan Pendukung',
                'subtitle' => 'Dukungan akademik dan non-akademik untuk mahasiswa.',
                'is_active' => true,
            ],
            [
                'key' => 'gallery',
                'title' => 'Galeri Kehidupan Mahasiswa',
                'subtitle' => 'Dokumentasi kegiatan dan momen terbaik di kampus.',
                'is_active' => true,
            ],
        ]);

        $items = [
            [
                'title' => 'Music & Performance',
                'category' => 'organizations',
                'description' => 'Komunitas musik, band, paduan suara, dan seni pertunjukan.',
                'icon_class' => 'bi bi-music-note-beamed',
                'badge_text' => '15+ Grup',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Cultural Organizations',
                'category' => 'organizations',
                'description' => 'Organisasi budaya untuk merayakan keberagaman.',
                'icon_class' => 'bi bi-globe-americas',
                'badge_text' => '20+ Grup',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Academic Clubs',
                'category' => 'organizations',
                'description' => 'Klub akademik yang mendukung kompetisi dan riset.',
                'icon_class' => 'bi bi-book',
                'badge_text' => '25+ Klub',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Swimming',
                'category' => 'athletics',
                'description' => 'Program renang untuk kebugaran dan prestasi.',
                'image' => 'College/assets/img/education/activities-2.webp',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'title' => 'Basketball',
                'category' => 'athletics',
                'description' => 'Tim basket dengan latihan rutin dan kompetisi.',
                'image' => 'College/assets/img/education/activities-4.webp',
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'title' => 'Soccer',
                'category' => 'athletics',
                'description' => 'Program sepak bola untuk pembinaan atlet muda.',
                'image' => 'College/assets/img/education/activities-6.webp',
                'sort_order' => 6,
                'is_active' => true,
            ],
            [
                'title' => 'Tennis',
                'category' => 'athletics',
                'description' => 'Latihan tenis dengan fasilitas lapangan modern.',
                'image' => 'College/assets/img/education/activities-8.webp',
                'sort_order' => 7,
                'is_active' => true,
            ],
            [
                'title' => 'Student Housing',
                'category' => 'facilities',
                'description' => 'Hunian nyaman untuk mendukung kegiatan belajar.',
                'image' => 'College/assets/img/education/campus-4.webp',
                'sort_order' => 8,
                'is_active' => true,
            ],
            [
                'title' => 'Dining Facilities',
                'category' => 'facilities',
                'description' => 'Pilihan kantin dengan menu beragam dan sehat.',
                'image' => 'College/assets/img/education/campus-5.webp',
                'sort_order' => 9,
                'is_active' => true,
            ],
            [
                'title' => 'Modern Library',
                'category' => 'facilities',
                'description' => 'Perpustakaan dengan koleksi digital dan ruang belajar.',
                'image' => 'College/assets/img/education/campus-6.webp',
                'sort_order' => 10,
                'is_active' => true,
            ],
            [
                'title' => 'Recreation Center',
                'category' => 'facilities',
                'description' => 'Pusat kebugaran dan rekreasi untuk mahasiswa.',
                'image' => 'College/assets/img/education/campus-7.webp',
                'sort_order' => 11,
                'is_active' => true,
            ],
            [
                'title' => 'Health & Wellness',
                'category' => 'support_services',
                'description' => 'Layanan kesehatan dan konseling untuk mahasiswa.',
                'icon_class' => 'bi bi-heart-pulse',
                'link_label' => 'Learn More',
                'link_url' => '#',
                'sort_order' => 12,
                'is_active' => true,
            ],
            [
                'title' => 'Career Services',
                'category' => 'support_services',
                'description' => 'Bimbingan karier, magang, dan persiapan kerja.',
                'icon_class' => 'bi bi-briefcase',
                'link_label' => 'Learn More',
                'link_url' => '#',
                'sort_order' => 13,
                'is_active' => true,
            ],
            [
                'title' => 'Accessibility Services',
                'category' => 'support_services',
                'description' => 'Dukungan aksesibilitas untuk semua mahasiswa.',
                'icon_class' => 'bi bi-universal-access',
                'link_label' => 'Learn More',
                'link_url' => '#',
                'sort_order' => 14,
                'is_active' => true,
            ],
            [
                'title' => 'Student Life Gallery 1',
                'category' => 'gallery',
                'image' => 'College/assets/img/education/students-1.webp',
                'sort_order' => 15,
                'is_active' => true,
            ],
            [
                'title' => 'Student Life Gallery 2',
                'category' => 'gallery',
                'image' => 'College/assets/img/education/students-2.webp',
                'sort_order' => 16,
                'is_active' => true,
            ],
            [
                'title' => 'Student Life Gallery 3',
                'category' => 'gallery',
                'image' => 'College/assets/img/education/students-3.webp',
                'sort_order' => 17,
                'is_active' => true,
            ],
            [
                'title' => 'Student Life Gallery 4',
                'category' => 'gallery',
                'image' => 'College/assets/img/education/students-4.webp',
                'sort_order' => 18,
                'is_active' => true,
            ],
            [
                'title' => 'Student Life Gallery 5',
                'category' => 'gallery',
                'image' => 'College/assets/img/education/students-5.webp',
                'sort_order' => 19,
                'is_active' => true,
            ],
            [
                'title' => 'Student Life Gallery 6',
                'category' => 'gallery',
                'image' => 'College/assets/img/education/students-6.webp',
                'sort_order' => 20,
                'is_active' => true,
            ],
        ];

        foreach ($items as $item) {
            LandingStudentLifeItem::create($item);
        }
    }
}
