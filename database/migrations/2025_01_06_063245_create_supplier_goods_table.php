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
        Schema::create('supplier_goods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_id')->comment('공급사 아이디');
            $table->string('good_code', 100)->nullable()->comment('(공급사) 상품 코드');
            $table->string('supplier_attribute', 50)->nullable()->comment('공급사 상품 속성');
            $table->string('supplier_category', 100)->nullable()->comment('공급사 카테고리');
            $table->string('name', 191)->nullable()->comment('공급사 상품 이름');
            $table->string('origin', 100)->nullable()->comment('원산지');
            $table->string('maker', 100)->nullable()->comment('메이커');
            $table->string('brand', 100)->nullable()->comment('브랜드');
            $table->unsignedInteger('box_count')->nullable()->comment('박스 수량');
            $table->integer('quantity_in_box')->nullable()->comment('입수량');
            $table->string('min_order_count', 191)->nullable()->comment('최소 주문 수량');
            $table->string('barcode', 100)->nullable()->comment('상품 바코드');
            $table->string('spec', 191)->nullable()->comment('박스 규격');
            $table->unsignedInteger('inventory')->nullable()->comment('재고');
            $table->text('description')->nullable();
            $table->unsignedInteger('price')->nullable()->comment('가격');
            $table->unsignedInteger('suggested_selling_price')->nullable()->comment('판매 제안가격');
            $table->integer('suggested_retail_price')->nullable()->comment('권장 소비자가');
            $table->integer('supplier_monitoring_price')->nullable()->comment('공급사 모니터링 가격');
            $table->text('additional_information')->nullable()->comment('부가 정보');
            $table->boolean('is_runout')->nullable()->default(false)->comment('품절유무');
            $table->boolean('is_warehoused')->nullable()->default(true)->comment('입고 가능 유무');
            $table->boolean('is_shutdown')->nullable()->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplier_goods');
    }
};
