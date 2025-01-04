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
        Schema::create('register_option_good_requests', function (Blueprint $table) {
            $table->id();
            $table->integer('requester_id')->nullable();
            $table->integer('worker_id')->nullable();
            $table->string('title', 190);
            $table->string('request_file_url', 190)->nullable();
            $table->string('status', 10)->nullable()->default('등록대기');
            $table->string('respond_file_url', 190)->nullable();
            $table->text('memo')->nullable();
            $table->dateTime('created')->nullable();
            $table->dateTime('modified')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('register_option_good_requests');
    }
};
