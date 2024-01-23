<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Commodity>
 */
class CommodityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->uuid(),
            'sell_price' => fake()->randomNumber(6, true),
            'buy_price' => fake()->randomNumber(6, true),
            'demand' => fake()->randomNumber(6, true),
            'stock' => fake()->randomNumber(6, true)
        ];
    }
}
