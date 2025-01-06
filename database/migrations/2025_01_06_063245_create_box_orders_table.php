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
        Schema::create('box_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('cms_maestro_id');
            $table->unsignedInteger('warehouse_manager_id')->nullable();
            $table->integer('ct_box_supplier_id')->nullable();
            $table->string('title', 190);
            $table->date('order_date');
            $table->unsignedInteger('total_box_count')->nullable()->default('0');
            $table->unsignedInteger('total_order_price')->nullable();
            $table->dateTime('sent')->nullable();
            $table->dateTime('confirmed')->nullable();
            $table->dateTime('predict_warehoused')->nullable();
            $table->dateTime('warehoused')->nullable();
            $table->string('status', 25)->nullable()->default('발주작성중');
            $table->text('memo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('box_orders');
    }
};
