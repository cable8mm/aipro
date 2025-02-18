<?php

use App\Enums\CenterClass;
use App\Enums\SafeClass;
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
            $table->foreignId('author_id');
            $table->foreignId('supplier_id')->comment('공급사 아이디');
            $table->foreignId('supplier_item_id')->nullable()->comment('공급사 상품 아이디');
            $table->foreignId('box_id')->nullable()->comment('1개 패킹 시 사용되는 박스');
            $table->string('list_image', 190)->nullable()->comment('리스트이미지');
            $table->string('master_code', 255)->nullable();
            $table->foreignId('playauto_category_id')->nullable()->comment('플레이오토 카테고리 코드');
            $table->string('name', 255);
            $table->string('godo_name', 255)->nullable();
            $table->string('option', 100)->nullable()->comment('옵션');
            $table->integer('inventory')->nullable()->comment('재고 갯수');
            $table->unsignedInteger('supplier_out_of_stock_count')->default(0)->comment('공급사 품절 등록 횟수');
            $table->integer('safe_inventory')->default(0)->comment('안전 재고 갯수');
            $table->string('safe_class', 10)->default(SafeClass::S1->name);
            $table->string('center_class', 10)->default(CenterClass::M->name);
            $table->string('category', 255)->nullable();
            $table->string('maker', 255)->nullable();
            $table->string('brand', 191)->nullable();
            $table->integer('cost_price')->nullable()->comment('매입가');
            $table->integer('last_cost_price')->nullable()->comment('마지막 매입가');
            $table->integer('suggested_selling_price')->nullable()->comment('권장 판매가');
            $table->integer('suggested_retail_price')->nullable()->comment('권장 소비자가');
            $table->integer('supplier_monitoring_price')->nullable()->comment('공급사 모니터링 가격');
            $table->string('supplier_monitoring_status', 10)->nullable()->comment('fixed, manual');
            $table->boolean('supplier_monitoring_interruption')->nullable()->comment('공모가 위반시 공급중단');
            $table->integer('goods_price')->nullable()->comment('상품가격(판매가)');
            $table->string('spec', 255)->nullable()->comment('공급가 규격1(상품규격관련항목)');
            $table->string('order_rule', 255)->nullable()->comment('규격2 (입수수량 정보)');
            $table->string('barcode', 20)->nullable()->comment('바코드');
            $table->string('picking_zone_number', 30)->nullable()->comment('피킹 박스 번호');
            $table->string('item_division_color', 20)->nullable();
            $table->integer('ship_quantity')->default('1');
            $table->text('memo')->nullable();
            $table->string('print_classification', 190)->nullable()->comment('출력을 위한 분류');
            $table->char('naver_category', 20)->nullable()->comment('네이버 카테고리 ID');
            $table->string('naver_productid', 128)->nullable()->comment('네이버 가격비교 페이지 ID');
            $table->boolean('not_exist_naver_productid')->nullable()->comment('네이버 가격비교 페이지 ID 없음');
            $table->boolean('naver_lowest_price_wrong')->nullable()->comment('네이버 최저가 잘못됨');
            $table->integer('naver_lowest_price')->nullable()->comment('네이버 가격비교 최저가');
            $table->integer('internet_lowest_price')->nullable()->comment('인터넷 최저가');
            $table->integer('zero_margin_price')->nullable()->comment('제로마진판매가');
            $table->integer('suggested_sales_percent_margin')->nullable()->comment('제안판매마진(퍼센트)');
            $table->integer('suggested_selling_price_of_gms')->nullable()->comment('GMS판매제안가');
            $table->boolean('is_supplier_out_of_stock')->default(false)->comment('공급사 품절 여부');
            $table->boolean('can_be_shipped')->default(true)->comment('판매 여부(센터마감기준)');
            $table->boolean('is_shutdown')->default(false);
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
