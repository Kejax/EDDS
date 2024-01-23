<?php

namespace Database\Factories;

use App\Models\Enums\EconomyType;
use App\Models\Enums\GovernmentType;
use App\Models\Enums\SecurityLevel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\System>
 */
class SystemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->secondaryAddress(),
            'system_address' => fake()->randomNumber(9, true),
            'star_position_x' => fake()->numberBetween(0, 20_000),
            'star_position_y' => fake()->numberBetween(0, 20_000),
            'star_position_z' => fake()->numberBetween(0, 20_000),
            'arrival_body_id' => 0,
            'system_economy' => fake()->randomElement(EconomyType::cases())->value,
            'system_second_economy' => fake()->randomElement(EconomyType::cases())->value,
            'system_government' => fake()->randomElement(GovernmentType::cases())->value,
            'system_security' => fake()->randomElement(SecurityLevel::cases())->value,
            'population' => fake()->numberBetween(1_000, 10_000),
            'system_faction_id' => 0
        ];
    }
}
