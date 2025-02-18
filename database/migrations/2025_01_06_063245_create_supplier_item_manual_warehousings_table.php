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
        Schema::create('supplier_item_manual_warehousings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_item_id');
            $table->foreignId('author_id');
            $table->integer('manual_add_inventory_count');
            $table->text('memo')->nullable()->comment('수동 입고 이유');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplier_item_manual_warehousings');
    }
};
