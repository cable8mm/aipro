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
        Schema::create('supplier_goods_bak', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('ct_supplier_id')->nullable();
            $table->string('code', 255);
            $table->string('name', 255);
            $table->string('previous_name', 255)->nullable();
            $table->integer('box_count')->nullable();
            $table->integer('cost_price_without_vat')->nullable();
            $table->integer('cost_price_with_vat');
            $table->integer('suggest_good_price')->nullable();
            $table->integer('customer_good_price')->nullable();
            $table->string('additional_information', 255)->nullable();
            $table->dateTime('created')->nullable();
            $table->dateTime('modified')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplier_goods_bak');
    }
};
