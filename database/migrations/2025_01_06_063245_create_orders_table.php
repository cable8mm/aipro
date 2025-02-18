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
            $table->foreignId('box_id')->nullable()->comment('박스 아이디');
            $table->unsignedInteger('box_quantity')->nullable()->comment('박스 수량');
            $table->string('type', 191)->nullable()->comment('센터 요청 12개 타입');
            $table->integer('order_good_count')->default(0)->comment('주문 상품 갯수');
            $table->string('invoice_numbers', 191)->comment('송장번호들(csv)');
            $table->integer('printed_count')->default(0)->comment('출력 횟수');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
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
