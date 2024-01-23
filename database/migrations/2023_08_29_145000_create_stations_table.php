<?php

use App\Models\Enums\GovernmentType;
use App\Models\Enums\LandingPlatformSize;
use App\Models\Enums\StationType;
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
            $table->integer('system_address');
            $table->float('distance_from_star');
            $table->enum('landing_platform_size', array_column(LandingPlatformSize::cases(), 'value')); //
            $table->enum('station_type', array_column(StationType::cases(), 'value'));
            //$table->json('station_services'); TODO Make this to a seperate Model with table
            $table->json('station_economies'); // TODO Make this to a seperate model with relation
            $table->enum('station_government', array_column(GovernmentType::cases(), 'value'));
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
