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
        Schema::create('order_sheet_invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('cms_maestro_id');
            $table->string('name', 255);
            $table->string('excel_filepath', 255);
            $table->integer('order_row_count')->nullable();
            $table->integer('order_number_count')->nullable();
            $table->integer('order_good_count')->nullable();
            $table->integer('mismatched_order_good_count')->nullable();
            $table->string('invoice_filepath', 255);
            $table->longText('excel_json')->nullable();
            $table->string('status', 50)->nullable()->default("파일업로드");
            $table->dateTime('created')->nullable();
            $table->dateTime('modified')->nullable();
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