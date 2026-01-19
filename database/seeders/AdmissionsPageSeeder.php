<?php

namespace Database\Seeders;

use App\Models\AdmissionsApplicationStep;
use App\Models\AdmissionsCampusVisitOption;
use App\Models\AdmissionsCampusVisitSetting;
use App\Models\AdmissionsDeadline;
use App\Models\AdmissionsDeadlineSetting;
use App\Models\AdmissionsPageSetting;
use App\Models\AdmissionsRequestInfoSetting;
use App\Models\AdmissionsRequestProgram;
use App\Models\AdmissionsRequirement;
use App\Models\AdmissionsRequirementSetting;
use App\Models\AdmissionsTuition;
use App\Models\AdmissionsTuitionSetting;
use Illuminate\Database\Seeder;

class AdmissionsPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AdmissionsPageSetting::updateOrCreate(
            ['page_title' => 'Admissions'],
            [
                'breadcrumb_title' => 'Admissions',
                'steps_title' => 'Steps',
                'is_active' => true,
            ]
        );

        $steps = [
            ['step_number' => '01', 'title' => 'Submit Application', 'description' => 'Lengkapi formulir pendaftaran dengan data yang benar.'],
            ['step_number' => '02', 'title' => 'Send Documents', 'description' => 'Kumpulkan dokumen pendukung sesuai persyaratan.'],
            ['step_number' => '03', 'title' => 'Interview Process', 'description' => 'Ikuti seleksi atau wawancara jika diperlukan.'],
            ['step_number' => '04', 'title' => 'Decision Letter', 'description' => 'Pengumuman hasil seleksi akan disampaikan.'],
        ];

        foreach ($steps as $index => $step) {
            AdmissionsApplicationStep::updateOrCreate(
                ['title' => $step['title']],
                [
                    'step_number' => $step['step_number'],
                    'description' => $step['description'],
                    'sort_order' => $index + 1,
                    'is_active' => true,
                ]
            );
        }

        AdmissionsRequirementSetting::updateOrCreate(
            ['title' => 'Admission Requirements'],
            [
                'note' => 'Siswa internasional membutuhkan dokumen tambahan sesuai ketentuan.',
                'is_active' => true,
            ]
        );

        $requirements = [
            'Formulir pendaftaran lengkap',
            'Rapor/ijazah terakhir',
            'Foto terbaru',
            'Surat rekomendasi (jika ada)',
            'Biaya pendaftaran',
        ];

        foreach ($requirements as $index => $text) {
            AdmissionsRequirement::updateOrCreate(
                ['text' => $text],
                [
                    'sort_order' => $index + 1,
                    'is_active' => true,
                ]
            );
        }

        AdmissionsTuitionSetting::updateOrCreate(
            ['title' => 'Tuition & Fees'],
            [
                'aid_title' => 'Financial Aid Available',
                'aid_description' => 'Beasiswa tersedia untuk siswa berprestasi dan membutuhkan.',
                'aid_button_label' => 'Lihat Informasi Beasiswa',
                'aid_button_url' => '#',
                'is_active' => true,
            ]
        );

        $tuitions = [
            ['program' => 'Teknik Komputer', 'tuition' => 'Rp 3.500.000', 'fees' => 'Rp 750.000'],
            ['program' => 'Akuntansi', 'tuition' => 'Rp 3.200.000', 'fees' => 'Rp 700.000'],
            ['program' => 'Multimedia', 'tuition' => 'Rp 3.600.000', 'fees' => 'Rp 800.000'],
        ];

        foreach ($tuitions as $index => $tuition) {
            AdmissionsTuition::updateOrCreate(
                ['program' => $tuition['program']],
                [
                    'tuition' => $tuition['tuition'],
                    'fees' => $tuition['fees'],
                    'sort_order' => $index + 1,
                    'is_active' => true,
                ]
            );
        }

        AdmissionsRequestInfoSetting::updateOrCreate(
            ['title' => 'Request Information'],
            [
                'form_action' => '/College/forms/contact.php',
                'submit_label' => 'Request Information',
                'program_placeholder' => 'Program of Interest*',
                'is_active' => true,
            ]
        );

        $programs = ['Teknik Komputer', 'Akuntansi', 'Multimedia', 'Perhotelan'];
        foreach ($programs as $index => $program) {
            AdmissionsRequestProgram::updateOrCreate(
                ['name' => $program],
                [
                    'sort_order' => $index + 1,
                    'is_active' => true,
                ]
            );
        }

        AdmissionsDeadlineSetting::updateOrCreate(
            ['title' => 'Important Deadlines'],
            ['is_active' => true]
        );

        $deadlines = [
            ['date_text' => '1 Nov', 'title' => 'Gelombang 1', 'description' => 'Pendaftaran awal.'],
            ['date_text' => '15 Jan', 'title' => 'Gelombang 2', 'description' => 'Pendaftaran reguler.'],
            ['date_text' => '1 Mar', 'title' => 'Gelombang 3', 'description' => 'Pendaftaran terakhir.'],
        ];

        foreach ($deadlines as $index => $deadline) {
            AdmissionsDeadline::updateOrCreate(
                ['title' => $deadline['title']],
                [
                    'date_text' => $deadline['date_text'],
                    'description' => $deadline['description'],
                    'sort_order' => $index + 1,
                    'is_active' => true,
                ]
            );
        }

        AdmissionsCampusVisitSetting::updateOrCreate(
            ['title' => 'Schedule a Campus Visit'],
            [
                'description' => 'Kunjungi sekolah untuk melihat fasilitas dan lingkungan belajar kami.',
                'image_caption' => 'Experience our beautiful campus in person',
                'button_label' => 'Schedule Your Visit',
                'button_url' => '#',
                'virtual_label' => 'Take a Virtual Tour',
                'virtual_url' => '#',
                'is_active' => true,
            ]
        );

        $visitOptions = [
            ['icon_class' => 'bi bi-calendar-check', 'text' => 'Daily campus tours (Mon-Fri, 10am & 2pm)'],
            ['icon_class' => 'bi bi-people', 'text' => 'Information sessions with admissions staff'],
            ['icon_class' => 'bi bi-building', 'text' => 'Residence hall viewings'],
            ['icon_class' => 'bi bi-mortarboard', 'text' => 'Faculty meetings (by appointment)'],
        ];

        foreach ($visitOptions as $index => $option) {
            AdmissionsCampusVisitOption::updateOrCreate(
                ['text' => $option['text']],
                [
                    'icon_class' => $option['icon_class'],
                    'sort_order' => $index + 1,
                    'is_active' => true,
                ]
            );
        }
    }
}
