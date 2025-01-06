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
        Schema::create('set_goods', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('cms_maestro_id')->nullable();
            $table->string('playauto_master_code', 255)->nullable();
            $table->string('godo_code', 255)->nullable();
            $table->string('featured_good_list', 255)->nullable();
            $table->string('name', 255)->nullable();
            $table->integer('goods_price')->nullable();
            $table->integer('last_cost_price')->nullable();
            $table->integer('zero_margin_price')->nullable();
            $table->integer('suggested_selling_price_of_gms')->nullable();
            $table->boolean('is_gift')->nullable()->default('0');
            $table->boolean('is_shutdowned')->nullable()->default('0');
            $table->string('goods_bar', 190)->nullable();
            $table->boolean('is_my_shop_sale')->nullable();
            $table->boolean('is_other_shop_sale')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('set_goods');
    }
};
