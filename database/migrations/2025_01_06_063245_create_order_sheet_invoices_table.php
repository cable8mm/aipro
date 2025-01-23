<?php

use App\Enums\Status;
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
        Schema::create('order_sheet_invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id');
            $table->string('excel_filepath', 255)->nullable();
            $table->integer('order_row_count')->nullable()->comment('주문 행수');
            $table->integer('order_number_count')->nullable()->comment('주문수');
            $table->integer('order_good_count')->nullable()->comment('주문 상품수');
            $table->integer('mismatched_order_good_count')->nullable()->comment('미매칭 상품수');
            $table->string('invoice_filepath', 255)->nullable();
            $table->json('excel_json')->nullable();
            $table->string('status', 50)->nullable()->default(Status::WAITING)->comment('에러,파일업로드,정상확인완료,주문서입력완료');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_sheet_invoices');
    }
};
