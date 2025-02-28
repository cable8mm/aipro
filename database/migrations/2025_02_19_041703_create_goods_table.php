<?php

use App\Models\Item;
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
        Schema::create('goods', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'author_id')->constrained()->comment('작성자 아이디');
            $table->foreignIdFor(Item::class)->constrained()->comment('아이템 아이디');
            $table->string('list_image', 190)->nullable()->comment('리스트이미지');
            $table->string('goods_code', 255)->nullable()->comment('상품코드');
            $table->string('name', 255);
            $table->string('option', 100)->nullable()->comment('옵션');
            $table->integer('goods_price')->nullable()->comment('상품가격(판매가)');
            $table->text('memo')->nullable();
            $table->integer('zero_margin_price')->nullable()->comment('제로마진판매가');
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
