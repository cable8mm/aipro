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
        Schema::create('shutdown_goods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id');
            $table->string('master_code', 150);
            $table->string('title', 255);
            $table->string('reason', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shutdown_goods');
    }
};
