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
            $table->unsignedInteger('cms_maestro_id')->nullable();
            $table->integer('ct_supplier_id');
            $table->unsignedInteger('ct_supplier_good_id')->nullable();
            $table->integer('ct_box_id')->nullable();
            $table->string('list_image', 190)->nullable();
            $table->unsignedInteger('godo_code')->nullable();
            $table->string('retail_code', 255)->nullable();
            $table->string('playauto_master_code', 255)->nullable();
            $table->string('center_code', 150);
            $table->unsignedInteger('playauto_category_id')->nullable()->default('0');
            $table->string('name', 255);
            $table->string('godo_name', 255)->nullable();
            $table->string('option', 100)->nullable()->default('');
            $table->integer('inventory')->nullable()->default('0');
            $table->unsignedInteger('supplier_out_of_stock_count')->nullable()->default('0');
            $table->text('manual_add_inventory_memo')->nullable();
            $table->integer('safe_inventory')->nullable()->default('0');
            $table->char('safe_class', 1)->nullable()->default('3');
            $table->char('center_class', 1)->nullable()->default('H');
            $table->string('category', 255)->nullable();
            $table->string('maker', 255)->nullable();
            $table->string('brand', 191)->nullable();
            $table->integer('cost_price')->nullable();
            $table->integer('last_cost_price')->nullable();
            $table->integer('suggested_selling_price')->nullable();
            $table->integer('suggestioned_retail_price')->nullable();
            $table->integer('supplier_monitoring_price')->nullable();
            $table->string('supplier_monitoring_status', 10)->nullable();
            $table->boolean('supplier_monitoring_interruption')->nullable()->default('0');
            $table->integer('goods_price')->nullable();
            $table->unsignedInteger('goods_price_wemake2')->nullable();
            $table->integer('goods_price_holapetshop')->nullable();
            $table->string('supplier_name', 255)->nullable();
            $table->integer('supplier_request_price')->nullable();
            $table->string('supplier_good_code', 100)->nullable();
            $table->string('spec', 255)->nullable();
            $table->string('order_rule', 255)->nullable();
            $table->string('barcode_type', 50)->nullable()->default('일반');
            $table->string('barcode', 255)->nullable()->default('');
            $table->string('generated_barcode', 255)->nullable();
            $table->string('picking_box_number', 255)->nullable();
            $table->string('storage_box_zone', 255)->nullable();
            $table->string('goods_division_color', 255)->nullable();
            $table->integer('ship_quantity')->default('1');
            $table->text('memo')->nullable();
            $table->string('memo_for_center', 255)->nullable();
            $table->string('good_classification', 30)->nullable();
            $table->string('print_classification', 190)->nullable();
            $table->char('naver_category', 20)->nullable();
            $table->string('naver_productid', 128)->nullable();
            $table->boolean('not_exist_naver_productid')->nullable()->default('0');
            $table->boolean('naver_lowest_price_wrong')->nullable()->default('0');
            $table->integer('naver_lowest_price')->nullable();
            $table->integer('internet_lowest_price')->nullable();
            $table->integer('zero_margin_price')->nullable();
            $table->integer('suggested_sales_percent_margin')->nullable();
            $table->integer('suggested_selling_price_of_gms')->nullable();
            $table->boolean('is_hi300')->nullable()->default('0');
            $table->boolean('is_supplier_out_of_stock')->nullable()->default('0');
            $table->boolean('is_my_shop_sale')->nullable();
            $table->boolean('is_other_shop_sale')->nullable();
            $table->boolean('is_not_playauto_used')->nullable()->default('0');
            $table->boolean('is_playauto_done')->nullable()->default('0');
            $table->boolean('is_requested_shutdown')->nullable()->default('0');
            $table->boolean('is_requested_reborn')->nullable()->default('0');
            $table->boolean('is_shutdowned')->nullable()->default('0');
            $table->boolean('is_scm_manager_confirmed')->nullable()->default('0');
            $table->dateTime('last_warehoused')->nullable();
            $table->dateTime('supplier_out_of_stock_on_datetime')->nullable();
            $table->dateTime('supplier_out_of_stock_off_datetime')->nullable();
            $table->dateTime('created')->nullable();
            $table->dateTime('modified')->nullable();
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
