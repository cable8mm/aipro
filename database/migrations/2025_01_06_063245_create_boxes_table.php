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
        Schema::create('boxes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'author_id')->constrained()->comment('작성자 아이디');
            $table->string('location_id', 10)->comment('위치 코드');
            $table->foreign('location_id')->references('id')->on('locations');
            $table->string('name', 100)->comment('박스 이름');
            $table->string('sku', 50)->comment('박스 SKU');
            $table->unsignedInteger('units_per_case')->default(1)->comment('입수량');
            $table->unsignedInteger('size')->comment('박스 사이즈');
            $table->integer('delivery_price')->nullable()->comment('배송 금액');
            $table->integer('cost_price')->nullable()->comment('매입가');
            $table->bigInteger('inventory')->default(0)->comment('재고 수량');
            $table->string('memo', 255)->nullable()->comment('메모');
            $table->boolean('is_default')->default(false)->comment('기본 박스 여부, 주문서에 별도의 박스 규격이 없다면 이 박스를 사용');
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
