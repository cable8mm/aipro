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
        Schema::create('mismatched_order_shipments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id')->comment('등록자');
            $table->foreignId('order_sheet_invoice_id')->nullable();
            $table->string('order_no', 100)->nullable()->comment('주문고유번호');
            $table->string('site', 100)->nullable()->comment('판매사이트');
            $table->string('master_goods_cd', 100)->nullable()->comment('마스터상품코드');
            $table->string('goods_nm', 255)->nullable()->comment('상품명');
            $table->string('option', 255)->nullable()->comment('주문선택사항');
            $table->text('json')->nullable()->comment('주문 전체 데이터');
            $table->string('status', 100)->comment('Status::class');
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
