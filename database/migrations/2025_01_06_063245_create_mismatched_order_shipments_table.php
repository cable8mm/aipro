<?php

use App\Enums\MismatchedOrderShipmentStatus;
use App\Models\OrderSheetWaybill;
use App\Models\User;
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
        Schema::create('mismatched_order_shipments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'author_id')->constrained()->comment('작성자 아이디');
            $table->foreignIdFor(OrderSheetWaybill::class)->constrained()->comment('주문및송장 아이디');
            $table->string('order_no', 100)->nullable()->comment('주문고유번호');
            $table->string('site', 100)->nullable()->comment('판매사이트');
            $table->string('goods_cd', 100)->nullable()->comment('마스터상품코드');
            $table->string('goods_nm', 255)->nullable()->comment('상품명');
            $table->string('option', 255)->nullable()->comment('주문선택사항');
            $table->text('json')->nullable()->comment('주문 전체 데이터');
            $table->enum('status', MismatchedOrderShipmentStatus::keys())->default(MismatchedOrderShipmentStatus::READY)->comment('아이템 상태');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mismatched_order_shipments');
    }
};
