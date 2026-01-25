<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ContactSetting;

class ContactSettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['key' => 'map_api_key', 'value' => '', 'description' => 'Google Maps API Key'],
            ['key' => 'notification_email', 'value' => 'admin@smksronas.sch.id', 'description' => 'Email to receive contact form notifications'],
            ['key' => 'auto_reply_message', 'value' => 'Thank you for contacting us. We will get back to you shortly.', 'description' => 'Auto-reply message for contact form'],
        ];

        foreach ($settings as $setting) {
            ContactSetting::create($setting);
        }
    }
}
