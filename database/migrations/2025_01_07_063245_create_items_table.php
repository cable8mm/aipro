<?php

use App\Enums\ItemInventoryLevel;
use App\Enums\ItemStatus;
use App\Models\Box;
use App\Models\Supplier;
use App\Models\SupplierItem;
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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'author_id')->constrained()->comment('작성자 아이디');
            $table->foreignIdFor(Supplier::class)->nullable()->constrained()->comment('공급사 아이디');
            $table->foreignIdFor(SupplierItem::class)->nullable()->constrained()->comment('공급사 아이디');
            $table->foreignIdFor(Box::class)->nullable()->constrained()->comment('공급사 아이디');
            $table->string('location_id', 10)->comment('위치 코드');
            $table->foreign('location_id')->references('id')->on('locations');
            $table->string('sku', 255)->nullable();
            $table->unsignedInteger('units_per_case')->default(1)->comment('입수량');
            $table->string('name', 255);
            $table->bigInteger('inventory')->default(0)->comment('재고 갯수');
            $table->unsignedInteger('supplier_out_of_stock_count')->default(0)->comment('공급사 품절 등록 횟수');
            $table->integer('safe_inventory')->default(0)->comment('안전 재고 갯수');
            $table->string('inventory_level', 30)->default(ItemInventoryLevel::LEVEL_1->name);
            $table->string('category', 255)->nullable();
            $table->string('maker', 255)->nullable();
            $table->string('brand', 191)->nullable();
            $table->integer('cost_price')->nullable()->comment('매입가');
            $table->integer('last_cost_price')->nullable()->comment('마지막 매입가');
            $table->integer('zero_margin_price')->nullable()->comment('제로마진 가격');
            $table->integer('suggested_selling_price')->nullable()->comment('소매판매 판매');
            $table->integer('suggested_retail_price')->nullable()->comment('도매판매 제안가');
            $table->string('spec', 255)->nullable()->comment('공급가 규격1(상품규격관련항목)');
            $table->string('order_rule', 255)->nullable()->comment('규격2 (입수수량 정보)');
            $table->string('barcode', 20)->nullable()->comment('바코드');
            $table->integer('ship_quantity')->default(1);
            $table->text('memo')->nullable();
            $table->string('print_classification', 190)->nullable()->comment('출력을 위한 분류');
            $table->boolean('is_supplier_out_of_stock')->default(false)->comment('공급사 품절 여부');
            $table->enum('status', ItemStatus::names())->default(ItemStatus::ACTIVE->name)->comment('아이템 상태');
            $table->dateTime('discontinued_at')->nullable()->comment('상품 단종 날짜');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
