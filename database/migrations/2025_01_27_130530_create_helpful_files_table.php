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
        Schema::create('helpful_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id')->comment('작성자');
            $table->string('attachment', 255)->nullable()->comment('파일명');
            $table->string('description', 255)->comment('설명');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('helpful_files');
    }
};
