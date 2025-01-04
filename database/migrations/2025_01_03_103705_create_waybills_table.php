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
        Schema::create('waybills', function (Blueprint $table) {
            $table->string('NO', 190)->nullable();
            $table->string('waybill_number', 190);
            $table->string('송하인', 255)->nullable();
            $table->string('받는분', 255)->nullable();
            $table->string('전화번호', 255)->nullable();
            $table->string('휴대번호', 255)->nullable();
            $table->text('주소')->nullable();
            $table->string('현재상태', 255)->nullable();
            $table->string('최종상품점소', 255)->nullable();
            $table->string('처리시간', 255)->nullable();
            $table->string('접수일자', 255)->nullable();
            $table->string('집화일자', 255)->nullable();
            $table->string('배달일', 255)->nullable();
            $table->string('인수자', 255)->nullable();
            $table->string('집화상위점소', 255)->nullable();
            $table->string('집화점소', 255)->nullable();
            $table->string('배달상위점소', 255)->nullable();
            $table->string('배달점소', 255)->nullable();
            $table->string('주문번호', 255)->nullable();
            $table->string('품명', 255)->nullable();
            $table->string('운임구분', 255)->nullable();
            $table->string('박스타입', 255)->nullable();
            $table->string('수량', 255)->nullable();
            $table->string('금액', 255)->nullable();
            $table->string('접수구분', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('waybills');
    }
};
