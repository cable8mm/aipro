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
        Schema::create('price_coefficients', function (Blueprint $table) {
            $table->id();
            $table->char('center_class', 1);
            $table->unsignedInteger('start_price');
            $table->unsignedInteger('end_price');
            $table->decimal('coefficient', 4, 3);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('price_coefficients');
    }
};
