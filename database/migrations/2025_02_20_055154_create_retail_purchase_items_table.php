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
        Schema::create('retail_purchase_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('retail_purchase_id')->comment('구매 아이디');
            $table->foreignId('item_id')->comment('상품 아이디');
            $table->bigInteger('quantity')->comment('수량');
            $table->bigInteger('unit_price')->comment('개당 가격');
            $table->bigInteger('subtotal')->comment('소계');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('retail_purchase_items');
    }
};
