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
            $table->foreignId('author_id');
            $table->foreignId('option_good_id');
            $table->string('master_code', 130);
            $table->string('name', 130);
            $table->unsignedBigInteger('goods_price')->nullable();
            $table->unsignedBigInteger('last_cost_price')->nullable()->comment('마지막 매입가');
            $table->unsignedBigInteger('zero_margin_price')->nullable()->comment('제로마진판매가');
            $table->unsignedBigInteger('suggested_selling_price')->nullable()->comment('GMS판매제안가');
            $table->unsignedInteger('order')->default(100);
            $table->boolean('is_my_shop_sale')->comment('내매장판매여부(센터마감기준)');
            $table->boolean('is_other_shop_sale')->comment('타매장판매여부(센터마감기준)');
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
