<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->sentence(2),
            'quantity' => $quantity = $this->numberBetween(0, 100),
            'status' => $quantity > 0 ? Product::isAvailable() : Product::UNAVAILABLE_PRODUCT,
            'image' => 
        ];
    }
}
