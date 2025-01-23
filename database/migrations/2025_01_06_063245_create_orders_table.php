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
            $table->foreignId('order_sheet_invoice_id')->nullable()->comment('주문서송장 아이디');
            $table->string('type', 50)->nullable()->comment('센터 요청 12개 타입');
            $table->integer('order_good_count')->nullable()->comment('주문 상품 갯수');
            $table->integer('printed_count')->nullable()->default('0')->comment('출력 횟수');
            $table->timestamps();
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
