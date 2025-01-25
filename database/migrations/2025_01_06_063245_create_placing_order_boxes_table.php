<?php

use App\Enums\PlacingOrder;
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
        Schema::create('placing_order_boxes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('box_placing_order_id');
            $table->foreignId('author_id');
            $table->foreignId('box_supplier_id');
            $table->foreignId('box_id');
            $table->foreignId('warehouse_manager_id');
            $table->unsignedInteger('order_count');
            $table->unsignedInteger('order_price');
            $table->integer('cost_count')->nullable();
            $table->integer('cost_price')->nullable();
            $table->dateTime('warehoused_at')->nullable();
            $table->string('status', 100)->nullable()->default(PlacingOrder::WAITING);
            $table->text('memo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('placing_order_boxes');
    }
};
