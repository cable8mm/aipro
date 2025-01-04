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
            $table->unsignedInteger('cms_maestro_id')->nullable();
            $table->unsignedInteger('ct_option_good_id')->nullable();
            $table->string('playauto_master_code', 130)->nullable();
            $table->string('name', 130)->nullable();
            $table->integer('goods_price')->nullable();
            $table->integer('last_cost_price')->nullable();
            $table->integer('zero_margin_price')->nullable();
            $table->integer('suggested_selling_price_of_gms')->nullable();
            $table->unsignedInteger('order')->nullable()->default("100");
            $table->string('goods_bar', 190)->nullable();
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
        Schema::dropIfExists('option_good_options');
    }
};