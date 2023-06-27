<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Ybazli\Faker\Facades\Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $date = fake()->dateTimeBetween('-6 weeks');

        $category = fake()->randomDigit();

        return [
            'user_id' => 1,
            'category_id' => $category == 0 ? null : $category,
            'title' => Faker::sentence(),
            'description' => Faker::paragraph(),
            'amount' => fake()->randomNumber(6),
            'type' => fake()->randomElement(['expense', 'income']),
            'created_at' => $date,
            'updated_at' => $date,
        ];
    }
}
