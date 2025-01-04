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
        Schema::create('register_good_requests', function (Blueprint $table) {
            $table->id();
            $table->integer('requester_id');
            $table->string('title', 255);
            $table->string('request_file_url', 255);
            $table->integer('worker_id')->nullable();
            $table->string('respond_file_url', 255)->nullable();
            $table->tinyInteger('has_supplier_monitoring_price')->default("0");
            $table->text('memo')->nullable();
            $table->string('status', 50)->default("등록대기");
            $table->dateTime('created')->nullable();
            $table->dateTime('modified')->nullable();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('register_good_requests');
    }
};