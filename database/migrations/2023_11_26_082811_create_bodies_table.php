<?php

use App\Models\Enums\BodyType;
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
        Schema::create('bodies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('system_address')->references('system_address')->on('systems');
            $table->unsignedBigInteger('body_id');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->enum('body_type', array_column(BodyType::cases(), 'value'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bodies');
    }
};
