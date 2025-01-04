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
        Schema::create('box_order_boxes', function (Blueprint $table) {
            $table->id();
            $table->integer('ct_box_order_id')->nullable();
            $table->integer('cms_maestro_id')->nullable();
            $table->integer('ct_box_supplier_id')->nullable();
            $table->unsignedInteger('ct_box_id')->nullable();
            $table->unsignedInteger('warehouse_manager_id')->nullable();
            $table->unsignedInteger('order_count')->nullable();
            $table->unsignedInteger('order_price')->nullable();
            $table->integer('cost_count')->nullable();
            $table->integer('cost_price')->nullable();
            $table->dateTime('warehoused')->nullable();
            $table->string('status', 100)->nullable()->default("미입고");
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
        Schema::dropIfExists('box_order_boxes');
    }
};