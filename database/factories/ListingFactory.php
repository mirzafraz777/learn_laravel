<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Listing>
 */
class ListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(5),
            'tags'=>'laravel, api, backend',
            'company' => fake()->company(),
            'location' => fake()->city(),
            'email' => fake()->companyEmail(),
            'website' => fake()->url(),
            'description' => fake()->paragraph(10),
        ];
    }
}
