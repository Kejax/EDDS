<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Commodity;
use App\Models\Station;
use App\Models\System;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $systems = System::factory(100)
        ->has(
            Station::factory()->count(fake()->randomDigit())
            ->has(
                Commodity::factory(100),
            ),
           // 'stations'
        )
        ->create();

        // Station::factory(100)
        // ->has(Commodity::factory(10))
        // ->create();

        // for ($i = 0; $i < 10; $i++) {
        //     $station = \App\Models\Station::factory()
        //     //->has(Commodity::factory()->count(10), 'commodity')
        //     ->create();

        //     #$station->refresh();

        //     for ($k = 0; $k < 1; $k++) {
        //         $commodity = Commodity::firstOrNew(['name'=>fake()->uuid(), 'sell_price'=>0, 'buy_price'=>0, 'demand'=>0, 'stock'=>0]);
        //         #Commodity::factory()->make();
        //         error_log($station->name);
        //         $station->commodity()->save($commodity);
        //     }
        // }
    }
}
