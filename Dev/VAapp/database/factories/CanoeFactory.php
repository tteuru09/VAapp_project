<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Canoe;
use App\Models\Place;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Canoe>
 */
class CanoeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->lexify('vaa-????'),
            'numberOfPlace' => fake()->randomElement([1, 3, 6]),
        ];
    }

    /* public function configure(): static
    {
        return $this->afterCreating(function (Canoe $canoe) {
            $nbPlace = $canoe->numberOfPlace;
            for($i = 1; $i < $nbPlace + 1; $i++) Place::factory()->create([
                'canoe_id' => $canoe->id,
                'position' => $i
            ]);
        });
    } */
}
