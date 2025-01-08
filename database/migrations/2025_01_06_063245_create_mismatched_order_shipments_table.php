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
            $table->foreignId('order_sheet_invoice_id')->nullable();
            $table->string('order_no', 100)->nullable();
            $table->string('site', 100)->nullable();
            $table->string('master_goods_cd', 100)->nullable();
            $table->string('goods_nm', 255)->nullable();
            $table->string('option', 255)->nullable();
            $table->text('json')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->string('status', 100)->nullable()->default('미처리');
            $table->timestamps();
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
