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
        Schema::create('set_goods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id')->comment('작성자');
            $table->string('master_code', 255)->nullable()->comment('마스터코드');
            $table->string('featured_good_list', 255)->nullable();
            $table->string('name', 255)->comment('상품명');
            $table->unsignedBigInteger('goods_price')->comment('판매가');
            $table->unsignedBigInteger('last_cost_price')->nullable()->comment('마지막 매입가');
            $table->unsignedBigInteger('zero_margin_price')->nullable()->comment('제로마진판매가');
            $table->boolean('is_shutdown')->default(false)->comment('판매 중지 유무');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('set_goods');
    }
};
