<?php

use App\Enums\ItemManualWarehousingType;
use App\Models\Box;
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
        Schema::create('box_manual_warehousings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'author_id')->constrained()->comment('작성자 아이디');
            $table->foreignIdFor(Box::class)->constrained()->comment('박스 아이디');
            $table->enum('type', ItemManualWarehousingType::keys())->comment('고객반품, 고객교환, 오배송교환, 실사조정, 공급사반품, 폐기, 오기입');
            $table->integer('amount');
            $table->text('memo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('box_manual_warehousings');
    }
};
