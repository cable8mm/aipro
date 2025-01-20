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
            $table->string('order_sheet_file', 255)->comment('주문서파일');
            $table->string('order_sheet_file_name')->comment('주문서파일 이름');
            $table->unsignedBigInteger('order_sheet_file_size')->comment('주문서파일 사이즈');
            $table->unsignedBigInteger('order_row_count')->default(0);
            $table->unsignedBigInteger('order_number_count')->default(0);
            $table->unsignedBigInteger('order_good_count')->default(0);
            $table->string('invoice_file', 255)->comment('운송장파일');
            $table->string('invoice_file_name')->comment('운송장파일 이름');
            $table->unsignedBigInteger('invoice_file_size')->comment('운송장파일 사이즈');
            $table->json('excel_json')->nullable();
            $table->string('status', 50)->nullable()->default(Status::WAITING->name);
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
