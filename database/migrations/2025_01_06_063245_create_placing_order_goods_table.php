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
        Schema::create('placing_order_goods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('placing_order_id')->comment('발주ID');
            $table->foreignId('author_id')->comment('등록자');
            $table->foreignId('good_id')->comment('상품');
            $table->integer('warehouse_manager_id')->nullable()->comment('입고 담당자');
            $table->unsignedInteger('order_count')->nullable()->comment('발주 수량');
            $table->unsignedInteger('order_price')->nullable()->comment('발주 금액');
            $table->unsignedInteger('supplier_confirmed_count')->nullable()->comment('공급사 확인 갯수');
            $table->integer('supplier_confirmed_price')->nullable()->comment('공급사 확인 가격');
            $table->unsignedInteger('cost_count')->nullable()->comment('매입 상품 수량');
            $table->integer('cost_promotion_count')->default(0)->comment('매입 프로모션 상품 수량');
            $table->integer('cost_price')->nullable()->comment('매입가');
            $table->boolean('is_promotion')->nullable()->default('0')->comment('프로모션 상품 여부');
            $table->dateTime('warehoused_at')->nullable()->comment('입고시각');
            $table->dateTime('placing_ordered_at')->nullable()->comment('발주시각');
            $table->string('status', 100)->default('확인중')->comment('확인중,미입고,입고중,입고완료');
            $table->text('memo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('placing_order_goods');
    }
};
