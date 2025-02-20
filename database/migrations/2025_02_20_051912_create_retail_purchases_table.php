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
        Schema::create('retail_purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cashier_id')->nullable()->comment('결제자 아이디');
            $table->foreignId('customer_id')->comment('고객 아이디');
            $table->bigInteger('total_price')->default(0)->comment('총 결제 금액');
            $table->string('payment_method', 50)->comment('결제 수단(cash, card, mobile, other)');
            $table->string('status')->comment('판매상태(completed, pending, canceled, refunded)');
            $table->bigInteger('discount')->comment('할인');
            $table->bigInteger('tax')->comment('세금(부가세)');
            $table->unsignedBigInteger('receipt_number')->comment('영수증 번호');
            $table->text('notes')->nullable()->comment('비고');
            $table->dateTime('purchased_at')->comment('구매일');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('retail_purchases');
    }
};
