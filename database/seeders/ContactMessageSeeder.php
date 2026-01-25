<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ContactMessage;

class ContactMessageSeeder extends Seeder
{
    public function run(): void
    {
        ContactMessage::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'subject' => 'Inquiry about Admissions',
            'message' => 'I would like to know more about the admission process for the upcoming academic year.',
            'status' => 'unread',
        ]);

        ContactMessage::create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'subject' => 'Partnership Opportunity',
            'message' => 'We are interested in collaborating with your school for an event.',
            'status' => 'read',
        ]);
    }
}
