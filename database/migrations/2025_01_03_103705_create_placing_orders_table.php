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
        Schema::create('placing_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('cms_maestro_id');
            $table->unsignedInteger('warehouse_manager_id')->nullable();
            $table->unsignedInteger('ct_supplier_id');
            $table->string('title', 190);
            $table->date('order_date');
            $table->unsignedInteger('total_good_count')->nullable()->default('0');
            $table->unsignedInteger('total_order_price')->nullable();
            $table->integer('order_discount_percent')->nullable()->default('0');
            $table->boolean('is_applied_order_discount_percent')->nullable();
            $table->dateTime('sent')->nullable();
            $table->dateTime('confirmed')->nullable();
            $table->date('predict_warehoused')->nullable();
            $table->dateTime('warehoused')->nullable();
            $table->string('status', 25)->nullable()->default('발주작성중');
            $table->text('memo')->nullable();
            $table->dateTime('created')->nullable();
            $table->dateTime('modified')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('placing_orders');
    }
};
