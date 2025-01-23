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
            $table->foreignId('author_id');
            $table->foreignId('warehouse_manager_id')->nullable();
            $table->foreignId('box_supplier_id')->nullable();
            $table->string('title', 190);
            $table->dateTime('ordered_at');
            $table->unsignedInteger('total_box_count')->nullable()->default('0');
            $table->unsignedInteger('total_order_price')->nullable();
            $table->dateTime('sent_at')->nullable();
            $table->dateTime('confirmed_at')->nullable();
            $table->dateTime('predict_warehoused_at')->nullable();
            $table->dateTime('warehoused_at')->nullable();
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
