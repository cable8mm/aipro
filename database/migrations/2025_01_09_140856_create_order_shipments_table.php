<?php

use App\Models\OrderSheetWaybill;
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
        Schema::create('order_shipments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(OrderSheetWaybill::class)->constrained()->comment('주문과송장 아이디');
            $table->string('orderNo', 255)->nullable()->comment('주문고유번호');
            $table->string('site', 255)->nullable()->comment('판매사이트');
            $table->string('registDate', 255)->nullable()->comment('수집일');
            $table->string('orderDate', 255)->nullable()->comment('주문일');
            $table->string('paymentDate', 255)->nullable()->comment('결제일');
            $table->string('statusDate', 255)->nullable()->comment('상태변경일');
            $table->string('deliveryDate', 255)->nullable()->comment('배송일');
            $table->string('status', 255)->nullable()->default('상품준비중')->comment('상태');
            $table->string('siteOrderNo', 255)->nullable()->comment('판매사이트 주문번호');
            $table->string('siteGoodsCd', 255)->nullable()->comment('판매사이트 상품코드');
            $table->string('goodsNm', 255)->nullable()->comment('상품명');
            $table->string('option', 255)->nullable()->comment('주문선택사항');
            $table->unsignedInteger('optionPrice')->nullable()->comment('주문선택사항금액');
            $table->string('additionalOption', 255)->nullable()->comment('추가구매옵션');
            $table->unsignedInteger('additionalOptionPrice')->nullable()->comment('추가구매옵션금액');
            $table->unsignedInteger('costPrice')->nullable()->comment('원가');
            $table->unsignedInteger('fixedPrice')->nullable()->comment('공급가');
            $table->unsignedInteger('totalPrice')->nullable()->comment('판매가');
            $table->unsignedInteger('amount')->nullable()->comment('주문수량');
            $table->unsignedInteger('totalAmount')->nullable()->comment('총주문수량');
            $table->unsignedInteger('confirmAmount')->nullable();
            $table->string('deliveryType', 255)->nullable()->comment('배송방법(원본)');
            $table->unsignedInteger('deliveryPrice')->nullable()->comment('배송비금액');
            $table->unsignedInteger('totalDeliveryPrice')->nullable()->comment('총배송비금액(묶음후)');
            $table->string('orderName', 255)->nullable()->comment('구매자명');
            $table->string('orderPhone', 255)->nullable()->comment('구매자전화번호');
            $table->string('orderCellPhone', 255)->nullable()->comment('구매자휴대폰번호');
            $table->string('receiverName', 255)->nullable()->comment('수령자명');
            $table->string('receiverPhone', 255)->nullable()->comment('수령자전화번호');
            $table->string('receiverCellPhone', 255)->nullable()->comment('수령자휴대폰번호');
            $table->string('postcode', 255)->nullable()->comment('배송지우편번호');
            $table->string('address', 255)->nullable()->comment('배송지주소');
            $table->text('deliveryMemo')->nullable()->comment('배송메시지');
            $table->string('waybillCompany', 255)->nullable()->comment('배송사명');
            $table->string('waybillNo', 255)->nullable()->comment('송장번호');
            $table->string('waybillFilePath', 255)->nullable();
            $table->unsignedInteger('waybillFilePage')->nullable();
            $table->string('waybillGoodsCd', 255)->nullable()->comment('주문서 상품코드');
            $table->string('payGoodsCd', 190)->nullable()->comment('결제용마스터상품코드, 일반상품/세트상품 코드가 저장됨');
            $table->string('goodsCd', 255)->nullable()->comment('마스터상품코드');
            $table->text('memo')->nullable()->comment('주의메시지');
            $table->text('sellerGoodsCd')->comment('판매자상품코드');
            $table->integer('validator')->nullable();
            $table->string('isSet', 1)->default('N');
            $table->string('printed', 1)->default('N');
            $table->string('downloaded', 1)->default('N');
            $table->string('shipped', 1)->default('N');
            $table->string('boxes', 255)->nullable();
            $table->string('shippable', 1)->default('Y');
            $table->unsignedInteger('inventory')->nullable()->comment('주문 등록 시점의 재고');
            $table->dateTime('printed_at')->nullable();
            $table->dateTime('downloaded_at')->nullable();
            $table->dateTime('shipped_at')->nullable();
            $table->dateTime('completed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_shipments');
    }
};
