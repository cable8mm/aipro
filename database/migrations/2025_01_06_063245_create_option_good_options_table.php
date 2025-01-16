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
        Schema::create('option_good_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('option_good_id');
            $table->string('master_code', 130);
            $table->string('name', 130);
            $table->unsignedBigInteger('goods_price')->nullable();
            $table->unsignedBigInteger('last_cost_price')->nullable();
            $table->unsignedBigInteger('zero_margin_price')->nullable();
            $table->unsignedInteger('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('option_good_options');
    }
};
