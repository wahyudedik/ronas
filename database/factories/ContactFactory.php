<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_name' => $this->faker->company,
            'address' => $this->faker->address,
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->email,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'operating_hours' => [
                'Monday-Friday' => '09:00 - 17:00',
                'Saturday' => '10:00 - 14:00',
            ],
            'social_media_links' => [
                'facebook' => $this->faker->url,
                'twitter' => $this->faker->url,
            ],
        ];
    }
}
