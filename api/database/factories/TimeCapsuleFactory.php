<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TimeCapsule>
 */
class TimeCapsuleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $dateTime = fake()->dateTimeBetween('-1 week', '+1 week');
        $isOpened = false;

        if ($dateTime < now()) {
            $isOpened = fake()->boolean();
        }

        return [
            'title' => fake()->words(fake()->numberBetween(1, 4), true),
            'message' => fake()->paragraph(),
            'open_at' => fake()->dateTimeBetween('-1 week', '+1 week'),
            'is_opened' => $isOpened,
        ];
    }
}
