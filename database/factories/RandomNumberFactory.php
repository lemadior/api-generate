<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\RandomNumber;

/**
 * @extends Factory<RandomNumber>
 */
class RandomNumberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Amount of the digit in the generated number
        $nbDigit = env('RANDOM_NUMBER_DIGITS', 2);

        return [
            'number' => fake()->unique()->randomNumber($nbDigit)
        ];
    }
}
