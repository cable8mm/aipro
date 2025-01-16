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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('ordered_email', 100)->nullable();
            $table->string('contact_name', 50)->nullable();
            $table->string('contact_tel', 40)->nullable();
            $table->string('contact_cel', 40)->nullable();
            $table->json('order_method')->comment('발주 방법');
            $table->string('balance_criteria', 100)->nullable()->comment('정산 기준');
            $table->unsignedBigInteger('min_order_price')->comment('최소 발주 금액');
            $table->text('additional_information')->nullable()->comment('판매자 정보 수동 싱크기능 제공 유무');
            $table->boolean('is_parceled')->default(true)->comment('택배발주 가능 유무');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
