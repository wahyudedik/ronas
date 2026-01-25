<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;

class ContactSeeder extends Seeder
{
    public function run(): void
    {
        Contact::create([
            'company_name' => 'SMKS Roudlotun Nasyiin',
            'address' => 'Jl. Pendidikan No.05, Berat Besuk, Beratkulon, Kec. Kemlagi, Kabupaten Mojokerto, Jawa Timur 61353',
            'phone' => '+62 812-3456-7890',
            'email' => 'info@smksronas.sch.id',
            'latitude' => -7.3875, // Approximate coordinates
            'longitude' => 112.3875,
            'operating_hours' => [
                'Monday-Friday' => '07:00 - 15:00',
                'Saturday' => '07:00 - 12:00',
                'Sunday' => 'Closed',
            ],
            'social_media_links' => [
                'facebook' => 'https://facebook.com/smksronas',
                'instagram' => 'https://instagram.com/smksronas',
                'twitter' => 'https://twitter.com/smksronas',
            ],
        ]);
    }
}
