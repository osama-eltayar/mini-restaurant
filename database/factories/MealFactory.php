<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MealFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'price'              => $this->faker->numberBetween(10, 1000),
            'description'        => $this->faker->text(),
            'quantity_available' => $this->faker->numberBetween(5, 20),
            'discount'           => $this->faker->numberBetween(5, 20),
        ];
    }
}
