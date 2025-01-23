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
            $table->foreignId('author_id')->constrained(
                table: 'users', indexName: 'register_good_requests_requester_user_id'
            )->onUpdate('cascade')->restrictOnDelete()->comment('요청자');
            $table->string('title', 255);
            $table->string('request_file_url', 255);
            $table->foreignId('worker_id')->constrained(
                table: 'users', indexName: 'register_good_requests_worker_user_id'
            )->onUpdate('cascade')->restrictOnDelete()->nullable();
            $table->string('respond_file_url', 255)->nullable();
            $table->boolean('has_supplier_monitoring_price')->default(false);
            $table->text('memo')->nullable();
            $table->string('status', 50)->default('waiting');
            $table->timestamps();
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
