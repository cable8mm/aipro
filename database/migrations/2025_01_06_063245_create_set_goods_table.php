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
        Schema::create('set_goods', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'author_id')->constrained()->comment('작성자 아이디');
            $table->string('goods_code', 255)->nullable()->comment('상품코드');
            $table->string('name', 255)->comment('상품명');
            $table->unsignedInteger('good_count')->comment('상품갯수');
            $table->unsignedBigInteger('goods_price')->nullable()->comment('판매가');
            $table->unsignedBigInteger('last_cost_price')->nullable()->comment('마지막 매입가');
            $table->unsignedBigInteger('zero_margin_price')->nullable()->comment('제로마진판매가');
            $table->boolean('is_active')->default(true)->comment('운영중');
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
