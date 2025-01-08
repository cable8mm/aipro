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
            $table->foreignId('user_id')->nullable();
            $table->foreignId('option_good_id')->nullable();
            $table->string('master_code', 130)->nullable();
            $table->string('name', 130)->nullable();
            $table->integer('goods_price')->nullable();
            $table->integer('last_cost_price')->nullable();
            $table->integer('zero_margin_price')->nullable();
            $table->integer('suggested_selling_price_of_gms')->nullable();
            $table->unsignedInteger('order')->nullable()->default('100');
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
