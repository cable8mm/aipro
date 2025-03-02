<?php

use App\Enums\RetailPurchaseStatus;
use App\Models\Customer;
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
        Schema::create('retail_purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'cashier_id')->constrained()->comment('결제자 아이디');
            $table->foreignIdFor(Customer::class)->constrained()->comment('고객 아이디');
            $table->string('code', 50)->comment('판매 코드');
            $table->bigInteger('item_count')->default(0)->comment('아이템수');
            $table->bigInteger('total_price')->default(0)->comment('총 결제 금액');
            $table->string('payment_method', 50)->comment('결제 수단(cash, card, mobile, other)');
            $table->string('status')->default(RetailPurchaseStatus::PENDING->value)->comment('판매상태(completed, pending, canceled, refunded)');
            $table->bigInteger('discount')->nullable()->comment('할인');
            $table->bigInteger('tax')->nullable()->comment('세금(부가세)');
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
