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
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id')->comment('등록자');
            $table->foreignId('warehouse_manager_id')->nullable()->comment('입고 담당자');
            $table->foreignId('supplier_id')->comment('공급사');
            $table->string('title', 190)->comment('제목');
            $table->dateTime('ordered_at')->nullable()->comment('발주 시각');
            $table->dateTime('sent_at')->nullable()->comment('발주서 보낸 시각');
            $table->dateTime('confirmed_at')->nullable()->comment('발주 확인 시각');
            $table->dateTime('predict_warehoused_at')->nullable()->comment('예상 입고 날짜');
            $table->dateTime('warehoused_at')->nullable()->comment('입고 시각');
            $table->unsignedInteger('total_good_count')->default('0')->comment('발주 총 상품 갯수');
            $table->unsignedInteger('total_order_price')->comment('발주 총 금액');
            $table->integer('order_discount_percent')->default('0')->comment('발주 할인 퍼센트');
            $table->string('status', 25)->default(Status::WAITING)->comment('발주 상태(발주작성중, 공급사확인중, 입고대기중, 입고중, 입고완료, 정산완료)');
            $table->text('memo')->nullable()->comment('메모');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_orders');
    }
};
