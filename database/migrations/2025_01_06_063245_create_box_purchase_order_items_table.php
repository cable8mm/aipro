<?php

use App\Enums\PurchaseOrderItemStatus;
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
        Schema::create('box_purchase_order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('box_purchase_order_id');
            $table->foreignId('author_id');
            $table->foreignId('box_id');
            $table->integer('quantity')->nullable()->comment('수량');
            $table->bigInteger('subtotal')->nullable()->comment('소계');
            $table->bigInteger('unit_price')->nullable()->comment('개당 매입가');
            $table->dateTime('warehoused_at')->nullable()->comment('입고시각');
            $table->dateTime('purchase_ordered_at')->nullable()->comment('발주시각');
            $table->string('status', 30)->default(PurchaseOrderItemStatus::PENDING->name)->comment('pending, received, inspected, stored, damaged, returned');
            $table->text('memo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('box_purchase_order_items');
    }
};
