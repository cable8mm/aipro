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
            $table->string('depth1', 100);
            $table->string('depth2', 100)->nullable();
            $table->string('depth3', 100)->nullable();
            $table->string('depth4', 100)->nullable();
            $table->boolean('is_active')->default(true);
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
