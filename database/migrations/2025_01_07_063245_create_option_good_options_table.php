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
        Schema::create('option_good_options', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'author_id')->constrained()->comment('작성자 아이디');
            $table->foreignId('option_good_id')->comment('주문및송장 아이디');
            $table->foreignId('option_good_optionable_id')->comment('주문및송장 모델');
            $table->string('name', 255)->comment('옵션상품옵션 이름, 옵션상품은 이름으로 매칭 됨.');
            $table->string('option_good_optionable_type', 100);
            $table->integer('sort_order')->comment('outl1ne/nova-sortable 패키지에 필요한 필드');
            $table->boolean('is_my_shop_sale')->comment('내매장판매여부(센터마감기준)');
            $table->boolean('is_other_shop_sale')->comment('타매장판매여부(센터마감기준)');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('option_good_options');
    }
};
