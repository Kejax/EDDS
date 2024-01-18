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
        Schema::create('systems', function (Blueprint $table) {
            $table->unsignedBigInteger('system_adress')->primary();
            $table->string('name');
            $table->float('star_position_x', 10, 2);
            $table->float('star_position_y', 10, 2);
            $table->float('star_position_z', 10, 2);
            $table->string('system_economy');
            $table->string('system_second_economy');
            $table->string('system_government');
            $table->string('system_security');
            $table->string('population');
            $table->unsignedBigInteger('system_faction_id');
            //$table->string('factions'); TODO Make a faction model with relations
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('systems');
    }
};
