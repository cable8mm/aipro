<?php

use App\Enums\PurchaseOrderStatus;
use App\Models\BoxSupplier;
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
        Schema::create('box_purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'author_id')->constrained()->comment('작성자 아이디');
            $table->foreignIdFor(User::class, 'warehouse_manager_id')->nullable()->constrained()->comment('창고 담당자 아이디');
            $table->foreignIdFor(BoxSupplier::class)->constrained()->comment('박스 공급사');
            $table->string('code', 50)->comment('박스발주코드');
            $table->bigInteger('total_box_count')->default(0)->comment('발주 총 상품 갯수');
            $table->bigInteger('total_order_price')->default(0)->comment('발주 총 금액');
            $table->dateTime('purchase_ordered_at')->nullable()->comment('발주 시각');
            $table->dateTime('predict_warehoused_at')->nullable()->comment('예상 입고 날짜');
            $table->dateTime('warehoused_at')->nullable()->comment('입고 시각');
            $table->bigInteger('discount_amount')->default('0')->comment('할인가');
            $table->string('status', 30)->default(PurchaseOrderStatus::PENDING->name)->comment('pending, received, inspected, stored, damaged, returned');
            $table->text('memo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('box_purchase_orders');
    }
};
