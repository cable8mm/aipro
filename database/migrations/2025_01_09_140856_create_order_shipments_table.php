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
        Schema::create('order_shipments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_sheet_invoice_id')->nullable();
            $table->string('orderNo', 255)->nullable();
            $table->string('site', 255)->nullable();
            $table->string('registDate', 255)->nullable();
            $table->string('orderDate', 255)->nullable();
            $table->string('paymentDate', 255)->nullable();
            $table->string('statusDate', 255)->nullable();
            $table->string('deliveryDate', 255)->nullable();
            $table->string('status', 255)->nullable()->default('상품준비중');
            $table->string('siteOrderNo', 255)->nullable();
            $table->string('siteGoodsCd', 255)->nullable();
            $table->string('goodsNm', 255)->nullable();
            $table->string('option', 255)->nullable();
            $table->integer('optionPrice')->nullable();
            $table->string('additionalOption', 255)->nullable();
            $table->integer('additionalOptionPrice')->nullable();
            $table->integer('costPrice')->nullable();
            $table->integer('fixedPrice')->nullable();
            $table->integer('totalPrice')->nullable();
            $table->integer('amount')->nullable();
            $table->integer('totalAmount')->nullable();
            $table->integer('confirmAmount')->nullable();
            $table->string('deliveryType', 255)->nullable();
            $table->integer('deliveryPrice')->nullable();
            $table->integer('totalDeliveryPrice')->nullable();
            $table->string('orderName', 255)->nullable();
            $table->string('orderPhone', 255)->nullable();
            $table->string('orderCellPhone', 255)->nullable();
            $table->string('receiverName', 255)->nullable();
            $table->string('receiverPhone', 255)->nullable();
            $table->string('receiverCellPhone', 255)->nullable();
            $table->string('postcode', 255)->nullable();
            $table->string('address', 255)->nullable();
            $table->text('deliveryMemo')->nullable();
            $table->string('invoiceCompany', 255)->nullable();
            $table->string('invoiceNo', 255)->nullable();
            $table->string('invoiceFilePath', 255)->nullable();
            $table->integer('invoiceFilePage')->nullable();
            $table->string('invoiceGoodsCd', 255)->nullable();
            $table->string('payGoodsCd', 190)->nullable();
            $table->string('masterGoodsCd', 255)->nullable();
            $table->text('memo')->nullable();
            $table->integer('validator')->nullable();
            $table->string('isSet', 1)->default('N');
            $table->string('printed', 1)->default('N');
            $table->string('downloaded', 1)->default('N');
            $table->string('shipped', 1)->default('N');
            $table->string('boxes', 255)->nullable();
            $table->string('shippable', 1)->default('Y');
            $table->integer('inventory')->nullable();
            $table->dateTime('printed_at')->nullable();
            $table->dateTime('downloaded_at')->nullable();
            $table->dateTime('shipped_at')->nullable();
            $table->dateTime('completed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_shipments');
    }
};
