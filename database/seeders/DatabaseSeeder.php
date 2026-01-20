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
        $this->call(NewsSeeder::class);
        $this->call(EventSeeder::class);
    }
}
