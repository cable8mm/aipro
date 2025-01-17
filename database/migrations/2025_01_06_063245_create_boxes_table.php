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
        Schema::create('boxes', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->nullable()->comment('박스 이름');
            $table->string('code', 50)->comment('박스 코드');
            $table->unsignedInteger('size')->comment('박스 사이즈');
            $table->integer('delivery_price')->nullable()->comment('배송 금액');
            $table->integer('box_price')->nullable()->comment('박스 가격');
            $table->unsignedInteger('inventory')->nullable()->default('0')->comment('재고 수량');
            $table->string('memo', 255)->nullable()->comment('메모');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boxes');
    }
};
