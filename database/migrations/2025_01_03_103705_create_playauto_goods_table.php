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
        Schema::create('playauto_goods', function (Blueprint $table) {
            $table->id();
            $table->string('SKU코드', 255)->nullable();
            $table->string('모델명', 255)->nullable();
            $table->string('브랜드', 255)->nullable();
            $table->string('제조사', 255)->nullable();
            $table->string('원산지', 255)->nullable();
            $table->string('상품명', 255)->nullable();
            $table->string('홍보문구', 255)->nullable();
            $table->string('요약상품명', 255)->nullable();
            $table->string('카테고리코드', 255)->nullable();
            $table->string('사용자분류명', 255)->nullable();
            $table->string('한줄메모', 255)->nullable();
            $table->string('시중가', 255)->nullable();
            $table->string('원가', 255)->nullable();
            $table->string('표준공급가', 255)->nullable();
            $table->string('판매가', 255)->nullable();
            $table->string('배송방법', 255)->nullable();
            $table->string('배송비', 255)->nullable();
            $table->string('과세여부', 255)->nullable();
            $table->string('판매수량', 255)->nullable();
            $table->string('실재고', 255)->nullable();
            $table->string('안전재고', 255)->nullable();
            $table->string('이미지1URL', 255)->nullable();
            $table->string('이미지2URL', 255)->nullable();
            $table->string('이미지3URL', 255)->nullable();
            $table->string('이미지4URL', 255)->nullable();
            $table->string('GIF생성', 255)->nullable();
            $table->string('이미지6URL', 255)->nullable();
            $table->string('이미지7URL', 255)->nullable();
            $table->string('이미지8URL', 255)->nullable();
            $table->string('이미지9URL', 255)->nullable();
            $table->string('이미지10URL', 255)->nullable();
            $table->string('추가정보입력사항', 255)->nullable();
            $table->string('옵션타입', 255)->nullable();
            $table->string('옵션구분', 255)->nullable();
            $table->text('선택옵션')->nullable();
            $table->string('입력형옵션', 255)->nullable();
            $table->string('추가구매옵션', 255)->nullable();
            $table->text('description')->nullable();
            $table->text('추가상세설명')->nullable();
            $table->string('광고/홍보', 255)->nullable();
            $table->string('제조일자', 255)->nullable();
            $table->string('유효일자', 255)->nullable();
            $table->string('사은품내용', 255)->nullable();
            $table->text('키워드')->nullable();
            $table->string('인증구분', 255)->nullable();
            $table->string('인증정보', 255)->nullable();
            $table->string('거래처', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('playauto_goods');
    }
};
