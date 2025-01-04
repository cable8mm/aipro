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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('order_sheet_invoice_id')->nullable();
            $table->string('type', 50)->nullable();
            $table->boolean('is_all_good_matched');
            $table->boolean('has_center_class_j');
            $table->integer('order_good_count')->nullable();
            $table->integer('printed_count')->nullable()->default('0');
            $table->dateTime('created')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
