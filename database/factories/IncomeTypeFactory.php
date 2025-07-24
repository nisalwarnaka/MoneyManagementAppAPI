<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\IncomeType>
 */
class IncomeTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'income_type' => $this->faker->word(),
            'max_amount' => $this->faker->numberBetween(10000, 100000),
            'min_amount' => $this->faker->numberBetween(1000, 10000),
        ];
    }
}
