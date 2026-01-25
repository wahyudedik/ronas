<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call(UserSeeder::class);
        $this->call(LandingPageSeeder::class);
        $this->call(AboutPageSeeder::class);
        $this->call(AdmissionsPageSeeder::class);
        $this->call(AcademicsPageSeeder::class);
        $this->call(StudentLifePageSeeder::class);
        $this->call(CampusFacilitiesSeeder::class);

        // News & Events
        $this->call(NewsCategorySeeder::class);
        $this->call(NewsSeeder::class);

        $this->call(EventCategorySeeder::class);
        $this->call(EventSeeder::class);

        // Alumni
        $this->call(AlumniSeeder::class);
        $this->call(AlumniStorySeeder::class);
        $this->call(AlumniEventSeeder::class);
        $this->call(GetInvolvedOptionSeeder::class);
        $this->call(DonationCampaignSeeder::class);

        // Contact
        $this->call(ContactSeeder::class);
        $this->call(ContactSettingSeeder::class);
        // $this->call(ContactMessageSeeder::class); // Optional: if you want dummy messages

        // Legal
        $this->call(LegalPageSeeder::class);
    }
}
