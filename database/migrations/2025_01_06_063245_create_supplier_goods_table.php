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
        Schema::create('supplier_goods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_id');
            $table->string('good_code', 100)->nullable();
            $table->string('supplier_category', 100)->nullable();
            $table->string('name', 191)->nullable();
            $table->string('origin', 100)->nullable();
            $table->string('maker', 100)->nullable();
            $table->string('brand', 100)->nullable();
            $table->unsignedInteger('box_count')->nullable();
            $table->integer('quantity_in_box')->nullable();
            $table->string('min_order_count', 191)->nullable();
            $table->string('barcode', 100)->nullable();
            $table->string('spec', 191)->nullable();
            $table->unsignedInteger('inventory')->nullable()->default('0');
            $table->text('description')->nullable();
            $table->unsignedInteger('price')->nullable();
            $table->unsignedInteger('suggested_selling_price')->nullable();
            $table->integer('suggestioned_retail_price')->nullable();
            $table->integer('supplier_monitoring_price')->nullable();
            $table->text('additional_information')->nullable();
            $table->boolean('is_runout')->nullable()->default('0');
            $table->boolean('is_warehoused')->nullable()->default('1');
            $table->boolean('is_shutdowned')->nullable()->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplier_goods');
    }
};
