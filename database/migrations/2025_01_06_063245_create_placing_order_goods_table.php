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
        Schema::create('placing_order_goods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('placing_order_id')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('good_id')->nullable();
            $table->integer('warehouse_manager_id')->nullable();
            $table->unsignedInteger('order_count')->nullable();
            $table->unsignedInteger('order_price')->nullable();
            $table->unsignedInteger('supplier_confirmed_count')->nullable();
            $table->integer('supplier_confirmed_price')->nullable();
            $table->unsignedInteger('cost_count')->nullable();
            $table->integer('cost_promotion_count')->nullable()->default('0');
            $table->integer('cost_price')->nullable();
            $table->boolean('is_promotion')->nullable()->default('0');
            $table->dateTime('warehoused_at')->nullable();
            $table->dateTime('ordered_at')->nullable();
            $table->string('status', 100)->nullable()->default('확인중');
            $table->text('memo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('placing_order_goods');
    }
};
