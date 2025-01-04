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
        Schema::create('mismatched_order_shipments', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('ct_order_sheet_invoice_id')->nullable();
            $table->string('orderNo', 100)->nullable();
            $table->string('site', 100)->nullable();
            $table->string('masterGoodsCd', 100)->nullable();
            $table->string('goodsNm', 255)->nullable();
            $table->string('option', 255)->nullable();
            $table->text('json')->nullable();
            $table->unsignedInteger('cms_maestro_id')->nullable();
            $table->string('status', 100)->nullable()->default('미처리');
            $table->dateTime('created')->nullable();
            $table->dateTime('modified')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mismatched_order_shipments');
    }
};
