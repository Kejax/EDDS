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
        Schema::table('stations', function (Blueprint $table) {
            $table->id();
            //$table->unique('marketId');
            $table->renameColumn('system', 'systemAddress');
            $table->string('landingPlatformSize');
            $table->renameColumn('type', 'stationType');
            $table->string('stationState');
            $table->renameColumn('services', 'stationServices');
            $table->string('stationEconomy');
            $table->string('stationWealth');
            $table->string('stationPopulation');
            $table->string('stationGovernment');
            $table->string('stationAllegiance');
            $table->string('minorFaction');
            $table->json('commodity');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stations', function (Blueprint $table) {
            //
        });
    }
};
