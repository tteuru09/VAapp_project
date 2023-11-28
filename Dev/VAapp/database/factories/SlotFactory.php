<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Slot>
 */
class SlotFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition($canoes, $users): array
    {
        return [
            'date' => fake()->date(),
            'start_time' => fake()->time(),
            'end_time' => fake()->time(),
            'full' => false,
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Slot $slot, $canoes, $users) {
            dd($canoes);
        });
    }
}
