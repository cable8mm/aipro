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
        Schema::create('inventory_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'author_id')->nullable()->constrained()->comment('작성자 아이디');
            $table->foreignIdFor(Item::class)->nullable()->constrained()->comment('상품 아이디');
            $table->string('type', 20)->comment('타입(입고,출고)');
            $table->bigInteger('quantity')->comment('입출고 수량');
            $table->bigInteger('after_quantity')->comment('입출고 후 재고 수량');
            $table->morphs('historyable');
            $table->unsignedBigInteger('cancel_id')->nullable()->comment('취소할 경우 저장되는 inventory_history_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_histories');
    }
};
