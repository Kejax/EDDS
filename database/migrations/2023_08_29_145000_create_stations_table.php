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
        /*Schema::create('stations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('marketId')->change();
            $table->integer('systemAdress'); // TODO
            $table->integer('distanceFromStar');
            $table->string('landingPlatformSize');
            $table->string('stationType');
            $table->string('stationState');
            $table->json('stationServices');
            $table->string('stationEconomy');
            $table->string('stationWealth');
            $table->string('stationPopulation');
            $table->string('stationGovernment');
            $table->string('stationAllegiance');
            $table->string('minorFaction');
            //$table->timestamp('stationUpdated');
            //$table->timestamp('locationUpdated');
            //$table->timestamp('marketUpdated');
            //$table->timestamp('shipyardUpdated');
            //$table->timestamp('outfittingUpdated');
            $table->timestamps();
        });*/
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stations');
    }
};
