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
        Schema::create('good_manual_warehousings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id')->comment('등록자');
            $table->foreignId('good_id')->comment('상품');
            $table->integer('manual_add_inventory_count')->comment('상품 차감 수량');
            $table->string('type', 100);
            $table->text('memo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('good_manual_warehousings');
    }
};
