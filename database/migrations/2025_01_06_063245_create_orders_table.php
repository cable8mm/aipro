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
            $table->unsignedBigInteger('id')->primary()->comment('주문번호');
            $table->foreignId('order_sheet_invoice_id')->comment('주문서송장 아이디');
            $table->string('type', 255)->nullable()->comment('센터 요청 12개 타입');
            $table->integer('order_good_count')->default(0)->comment('주문 상품 갯수');
            $table->integer('printed_count')->default(0)->comment('출력 횟수');
            $table->boolean('is_all_good_matched')->comment('모든 상품이 매칭되었는지');
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
