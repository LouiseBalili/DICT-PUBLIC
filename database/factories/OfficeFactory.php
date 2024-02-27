<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Office>
 */
class OfficeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'office_name' => fake()->words(3, true),
            'location' => fake()->sentence(3),
            'classification' => fake()->randomElement(['DICT-DTC', 'Tech4ED Center', 'Tech4ED Center', 'DICT-DTC',]),
        ];
    }
}
