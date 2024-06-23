<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'=>fake()->sentence(6),
            'sku'=>'SKU-'.fake()->numberBetween(001,999),
            'price'=>fake()->numberBetween(01,99),
            'description' => fake()->paragraph(3),

        ];
    }
}
