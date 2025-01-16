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
            $table->foreignId('user_id')->nullable();
            $table->foreignId('supplier_id');
            $table->foreignId('supplier_good_id')->nullable();
            $table->foreignId('box_id')->nullable();
            $table->string('list_image', 190)->nullable();
            $table->string('master_code', 255)->nullable();
            $table->foreignId('playauto_category_id')->nullable()->default('0');
            $table->string('name', 255);
            $table->string('godo_name', 255)->nullable();
            $table->string('option', 100)->nullable()->default('');
            $table->integer('inventory')->nullable()->default('0');
            $table->unsignedInteger('supplier_out_of_stock_count')->nullable()->default('0');
            $table->integer('safe_inventory')->nullable()->default('0');
            $table->char('safe_class', 2)->nullable()->default('3');
            $table->char('center_class', 1)->nullable()->default('M');
            $table->string('category', 255)->nullable();
            $table->string('maker', 255)->nullable();
            $table->string('brand', 191)->nullable();
            $table->integer('cost_price')->nullable();
            $table->integer('last_cost_price')->nullable();
            $table->integer('suggested_selling_price')->nullable();
            $table->integer('suggested_retail_price')->nullable();
            $table->integer('supplier_monitoring_price')->nullable();
            $table->string('supplier_monitoring_status', 10)->nullable();
            $table->boolean('supplier_monitoring_interruption')->nullable()->default('0');
            $table->integer('goods_price')->nullable();
            $table->string('spec', 255)->nullable();
            $table->string('order_rule', 255)->nullable();
            $table->string('barcode', 255)->nullable()->default('');
            $table->string('picking_box_number', 30)->nullable();
            $table->string('goods_division_color', 20)->nullable();
            $table->integer('ship_quantity')->default('1');
            $table->text('memo')->nullable();
            $table->string('print_classification', 190)->nullable();
            $table->char('naver_category', 20)->nullable();
            $table->string('naver_productid', 128)->nullable();
            $table->boolean('naver_lowest_price_wrong')->nullable()->default('0');
            $table->integer('naver_lowest_price')->nullable();
            $table->integer('internet_lowest_price')->nullable();
            $table->integer('zero_margin_price')->nullable();
            $table->boolean('is_supplier_out_of_stock')->nullable()->default('0');
            $table->boolean('can_be_shipped')->default(true);
            $table->boolean('is_shutdown')->nullable()->default('0');
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
