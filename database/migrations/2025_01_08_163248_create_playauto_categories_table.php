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
        Schema::create('playauto_categories', function (Blueprint $table) {
            $table->id();
            $table->string('depth1', 255)->nullable();
            $table->string('depth2', 255)->nullable();
            $table->string('depth3', 255)->nullable();
            $table->string('depth4', 255)->nullable();
            $table->boolean('is_active')->nullable()->default('0');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('playauto_categories');
    }
};
