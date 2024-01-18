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
        Schema::create('squadrone_members', function (Blueprint $table) {
            $table->foreignId('id')->references('id')->on('users');
            $table->foreignId('squadrone_id')->references('id')->on('squadrones');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('squadrone_members');
    }
};
