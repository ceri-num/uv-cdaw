<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EnergyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'energy_id' => rand(1, 5),
            'name' => $this->faker->unique()->word // A single unique word
        ];
    }
}
