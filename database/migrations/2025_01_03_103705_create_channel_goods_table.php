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
        Schema::create('channel_goods', function (Blueprint $table) {
            $table->id();
            $table->string('playauto_master_code', 190)->nullable();
            $table->string('goods_bar', 190)->nullable();
            $table->integer('coupang_price')->nullable();
            $table->string('coupang_sale_status', 100)->nullable();
            $table->string('coupang_approved', 100)->nullable();
            $table->integer('coupang_inventory')->nullable();
            $table->integer('kakaotalk_price')->nullable();
            $table->string('kakaotalk_sale_status', 100)->nullable();
            $table->integer('kakaotalk_inventory')->nullable();
            $table->integer('ssg_price')->nullable();
            $table->string('ssg_sale_status', 100)->nullable();
            $table->integer('ssg_inventory')->nullable();
            $table->integer('11st_price')->nullable();
            $table->string('11st_sale_status', 100)->nullable();
            $table->integer('11st_inventory')->nullable();
            $table->integer('gmarket_price')->nullable();
            $table->string('gmarket_sale_status', 100)->nullable();
            $table->unsignedInteger('gmarket_inventory')->nullable();
            $table->string('storefarm_channel', 100)->nullable();
            $table->integer('storefarm_price')->nullable();
            $table->string('storefarm_sale_status', 100)->nullable();
            $table->integer('storefarm_inventory')->nullable();
            $table->integer('auction_price')->nullable();
            $table->string('auction_sale_status', 100)->nullable();
            $table->integer('auction_inventory')->nullable();
            $table->integer('wemake_price')->nullable();
            $table->string('wemake_sale_status', 100)->nullable();
            $table->integer('gift_price')->nullable();
            $table->string('gift_sale_status', 100)->nullable();
            $table->integer('gift_inventory')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('channel_goods');
    }
};
