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
            $table->unsignedInteger('start_price')->comment('시작 가격');
            $table->unsignedInteger('end_price')->comment('끝 가격');
            $table->decimal('coefficient', 4, 3)->comment('가격*(계수)=판매가');
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
