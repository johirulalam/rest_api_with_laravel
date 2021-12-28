<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $seller = Seller::has('products')->get()->random();
        $buyer = User::all()->except($seller->id)->get()->random();
        return [
            'quantity' => $this->faker->numberBetween(0, 100),
            'buyer_id' => $buyer,
            'product_id' = $seller->products->random()->id,
        ];
    }
}
