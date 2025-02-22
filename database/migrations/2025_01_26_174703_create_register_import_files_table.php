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
        Schema::create('register_import_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id');
            $table->string('type', 30);
            $table->string('memo', 255)->nullable();
            $table->string('attachment', 255);
            $table->string('attachment_name', 255);
            $table->unsignedBigInteger('attachment_size');
            $table->string('status', 50)->default(Status::WAITING->name);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('register_import_files');
    }
};
