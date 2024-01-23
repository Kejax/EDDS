<?php

namespace App\Console;

use App\Models\System;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Create Galaxy Dump
        // $schedule->call(function () {

        //     $this->createGalaxyDump();

        // })->daily();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');

        Artisan::command('dump', function () {
            Kernel::createGalaxyDump();
        });
    }

    public static function createGalaxyDump() {

        Storage::put('galaxy_dump.json', '[');

        $systems = System::with('stations')->lazy();

        error_log("Test");

        $prepend = '';

        error_log("Test2");

        for ($i = 0; $i < $systems->count(); $i++) {
            $system = $systems->get($i);
            Storage::append('galaxy_dump.json', $prepend.$system->toJson());

            $prepend = ',';

        }


        Storage::append('galaxy_dump.json',']');
    }
}
