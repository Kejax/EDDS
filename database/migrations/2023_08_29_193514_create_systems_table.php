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
            $table->id();
            $table->string('name');
            $table->integer('systemAdress');
            $table->float('starPositionX');
            $table->float('starPositionY');
            $table->float('starPositionZ');
            $table->string('systemAllegiance');
            $table->string('systemEconomy');
            $table->string('systemSecondEconomy');
            $table->string('systemGovernment');
            $table->string('systemSecurity');
            $table->string('population');
            $table->string('factions');
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
