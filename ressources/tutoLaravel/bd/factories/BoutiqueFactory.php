<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BoutiqueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nom' => $this->faker->unique()->word // A single unique word
        ];
    }
}
