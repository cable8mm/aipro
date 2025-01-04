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
        Schema::create('goods_bars', function (Blueprint $table) {
            $table->id();
            $table->string('playauto_master_code', 190);
            $table->string('goods_bar', 190);
            $table->boolean('is_my_shop_sale')->nullable();
            $table->boolean('is_other_shop_sale')->nullable();
            $table->dateTime('created')->nullable();
            $table->dateTime('modified')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goods_bars');
    }
};
