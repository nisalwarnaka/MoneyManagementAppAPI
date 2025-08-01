<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class IncomeExpenseTransactionFactory extends Factory
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
            'expense_type' => $this->faker->word(),
            'income_type_id' => $this->faker->numberBetween(1, 10),
            'expense_type_id' => $this->faker->numberBetween(1, 10),
            'transaction_amount' => $this->faker->numberBetween(10000, 100000),
            'special_note' => $this->faker->sentence(),
            'month' => $this->faker->monthName(),
        ];
    }
}
