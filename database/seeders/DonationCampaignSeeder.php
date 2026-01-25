<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DonationCampaign;
use Illuminate\Support\Str;

class DonationCampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $campaigns = [
            [
                'campaign_name' => 'Scholarship Fund 2026',
                'description' => 'Help support underprivileged students with their tuition fees.',
                'target_amount' => 50000.00,
                'current_amount' => 12500.00,
                'deadline' => now()->addMonths(6)->toDateString(),
                'payment_methods' => json_encode(['Credit Card', 'Bank Transfer', 'PayPal']),
                'featured_image' => 'storage/alumni/donations/scholarship.jpg',
            ],
            [
                'campaign_name' => 'New Library Wing',
                'description' => 'Contributing to the construction of a new state-of-the-art library wing.',
                'target_amount' => 100000.00,
                'current_amount' => 45000.00,
                'deadline' => now()->addYear()->toDateString(),
                'payment_methods' => json_encode(['Bank Transfer']),
                'featured_image' => 'storage/alumni/donations/library.jpg',
            ],
        ];

        foreach ($campaigns as $campaign) {
            DonationCampaign::updateOrCreate(
                ['slug' => Str::slug($campaign['campaign_name'])],
                $campaign
            );
        }
    }
}
