<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AlumniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            AlumniStorySeeder::class,
            AlumniEventSeeder::class,
            GetInvolvedOptionSeeder::class,
            DonationCampaignSeeder::class,
        ]);
    }
}
