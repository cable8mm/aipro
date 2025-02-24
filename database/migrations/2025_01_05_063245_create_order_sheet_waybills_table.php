<?php

use App\Enums\OrderSheetWaybillStatus;
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
        Schema::create('order_sheet_waybills', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'author_id')->constrained()->comment('작성자 아이디');
            $table->unsignedBigInteger('row_count')->nullable()->comment('주문 행수');
            $table->unsignedBigInteger('order_count')->nullable()->comment('주문수');
            $table->unsignedBigInteger('order_good_count')->nullable()->comment('주문 상품수');
            $table->string('order_sheet_file', 255)->comment('주문서파일');
            $table->string('order_sheet_file_name')->comment('주문서파일 이름');
            $table->unsignedBigInteger('order_sheet_file_size')->comment('주문서파일 사이즈');
            $table->string('waybill_file', 255)->comment('운송장파일');
            $table->string('waybill_file_name')->comment('운송장파일 이름');
            $table->unsignedBigInteger('waybill_file_size')->comment('운송장파일 사이즈');
            $table->json('excel_json')->nullable();
            $table->string('status', 50)->nullable()->default(OrderSheetWaybillStatus::FILE_UPLOADED)->comment('에러,파일업로드,정상확인완료,주문서입력완료');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_sheet_waybills');
    }
};
