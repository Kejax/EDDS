<?php

namespace Database\Factories;

use App\Models\Enums\EconomyType;
use App\Models\Enums\GovernmentType;
use App\Models\Enums\LandingPlatformSize;
use App\Models\Enums\StationType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Station>
 */
class StationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'market_id' => rand(1, 5000000),
            'name' => fake()->company(),
            'system_address' => rand(0, 1000000),
            'distance_from_star' => rand(0, 5000),
            'landing_platform_size' => fake()->randomElement(LandingPlatformSize::cases())->value,
            'station_type' => fake()->randomElement(StationType::cases())->value,
            'station_economies' => [['Name' => fake()->randomElement(EconomyType::cases())->value, 'proportion' => 1.0]],
            'station_government' => fake()->randomElement(GovernmentType::cases())->value,
            'station_faction' => fake()->company()
        ];
    }
}
