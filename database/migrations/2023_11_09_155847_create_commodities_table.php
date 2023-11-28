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
        Schema::table('commodities', function (Blueprint $table) {
            $table->id();
            $table->renameColumn('marketId', 'market_id')->after('id');
            $table->string('name');
            $table->integer('sell_price');
            $table->integer('buy_price');
            $table->integer('demand');
            $table->integer('stock');
            $table->integer('mean_price')->nullable();
            $table->unique(['market_id', 'name'], 'unique_index');
            $table->timestamps();

            $table->removeColumn('commodities');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commodities');
    }
};
