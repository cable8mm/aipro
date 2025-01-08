<?php

use App\Enums\Status;
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
            $table->foreignId('user_id');
            $table->foreignId('warehouse_manager_id')->nullable();
            $table->foreignId('supplier_id');
            $table->string('title', 190);
            $table->dateTime('ordered_at')->nullable();
            $table->dateTime('sent_at')->nullable();
            $table->dateTime('confirmed_at')->nullable();
            $table->dateTime('predict_warehoused_at')->nullable();
            $table->dateTime('warehoused_at')->nullable();
            $table->unsignedInteger('total_good_count')->nullable()->default('0');
            $table->unsignedInteger('total_order_price')->nullable();
            $table->integer('order_discount_percent')->nullable()->default('0');
            $table->string('status', 25)->nullable()->default(Status::WAITING);
            $table->text('memo')->nullable();
            $table->timestamps();
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
