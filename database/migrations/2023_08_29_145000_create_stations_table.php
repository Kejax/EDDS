<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stations', function (Blueprint $table) {
            $table->unsignedBigInteger('market_id')->primary();
            $table->string('name');
            $table->integer('system_address'); // TODO add relationship in Model
            $table->float('distance_from_star');
            $table->enum('landing_platform_size', [
                'Small',
                'Medium',
                'Large'
            ]); //
            $table->enum('station_type', [
                'Asteroid',
                'Coriolis',
                'CraterOutpost',
                'CraterPort',
                'FleetCarrier',
                'MegaShip',
                'Ocellus',
                'Orbis',
                'Outpost',
                'Settlement'
            ]);
            //$table->json('station_services'); TODO Make this to a seperate Model with table
            $table->json('station_economies');
            $table->string('station_government'); // TODO Make this to an enum of type GovernmentType
            $table->string('station_faction');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stations');
    }
};
