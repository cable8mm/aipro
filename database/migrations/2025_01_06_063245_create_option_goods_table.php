<?php

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
        Schema::create('option_goods', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'author_id')->constrained()->comment('작성자 아이디');
            $table->string('goods_code', 130)->nullable()->comment('상품코드');
            $table->string('name', 255);
            $table->integer('option_count')->default(0)->comment('등록 옵션수');
            $table->integer('my_shop_sale_option_count')->default(0)->comment('자사몰 판매 가능 옵션수');
            $table->integer('other_shop_sale_option_count')->default(0)->comment('타사몰 판매 가능 옵션수');
            $table->boolean('is_my_shop_sale')->default(true)->comment('내매장판매여부(센터마감기준)');
            $table->boolean('is_other_shop_sale')->default(true)->comment('타매장판매여부(센터마감기준)');
            $table->boolean('is_active')->default(true)->comment('운영중');
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
