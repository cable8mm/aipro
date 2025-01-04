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
        Schema::create('channels', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('last_process_maestro_id')->nullable();
            $table->string('name', 255)->default("");
            $table->string('playauto_site', 190)->nullable();
            $table->string('siteid', 100)->nullable();
            $table->decimal('fee_rate', 5, 2)->nullable();
            $table->unsignedInteger('total_good_count')->nullable();
            $table->unsignedInteger('total_sale_good_count')->nullable();
            $table->integer('total_sold_out_good_count')->nullable();
            $table->integer('total_no_sale_good_count')->nullable();
            $table->string('filepath', 190)->nullable();
            $table->dateTime('last_processed')->nullable();
            $table->text('memo')->nullable();
            $table->boolean('is_active')->nullable()->default("1");
            $table->string('status', 100)->nullable()->default("판매중");
            $table->dateTime('created')->nullable();
            $table->dateTime('modified')->nullable();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('channels');
    }
};