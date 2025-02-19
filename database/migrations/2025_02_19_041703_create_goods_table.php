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
        Schema::create('goods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id');
            $table->foreignId('item_id')->comment('아이템 아이디');
            $table->string('list_image', 190)->nullable()->comment('리스트이미지');
            $table->string('goods_code', 255)->nullable()->comment('상품코드');
            $table->foreignId('playauto_category_id')->nullable()->comment('플레이오토 카테고리 코드');
            $table->string('name', 255);
            $table->string('option', 100)->nullable()->comment('옵션');
            $table->integer('supplier_monitoring_price')->nullable()->comment('공급사 모니터링 가격');
            $table->string('supplier_monitoring_status', 10)->nullable()->comment('fixed, manual');
            $table->boolean('supplier_monitoring_interruption')->nullable()->comment('공모가 위반시 공급중단');
            $table->integer('goods_price')->nullable()->comment('상품가격(판매가)');
            $table->text('memo')->nullable();
            $table->char('naver_category', 20)->nullable()->comment('네이버 카테고리 ID');
            $table->string('naver_productid', 128)->nullable()->comment('네이버 가격비교 페이지 ID');
            $table->boolean('not_exist_naver_productid')->nullable()->comment('네이버 가격비교 페이지 ID 없음');
            $table->boolean('naver_lowest_price_wrong')->nullable()->comment('네이버 최저가 잘못됨');
            $table->integer('naver_lowest_price')->nullable()->comment('네이버 가격비교 최저가');
            $table->integer('internet_lowest_price')->nullable()->comment('인터넷 최저가');
            $table->integer('zero_margin_price')->nullable()->comment('제로마진판매가');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goods');
    }
};
