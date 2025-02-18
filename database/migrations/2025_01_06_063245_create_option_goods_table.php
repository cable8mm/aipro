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
        Schema::create('option_goods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id');
            $table->string('sku', 130)->nullable();
            $table->string('name', 255);
            $table->integer('option_count')->default(0)->comment('등록 옵션수');
            $table->integer('my_shop_sale_option_count')->default(0)->comment('자사몰 판매 가능 옵션수');
            $table->integer('other_shop_sale_option_count')->default(0)->comment('타사몰 판매 가능 옵션수');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('option_goods');
    }
};
