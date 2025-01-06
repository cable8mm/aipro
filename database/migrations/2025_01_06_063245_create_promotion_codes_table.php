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
        Schema::create('promotion_codes', function (Blueprint $table) {
            $table->id();
            $table->string('playauto_master_code', 100);
            $table->string('godo_code', 255)->nullable();
            $table->string('memo', 190)->nullable();
            $table->dateTime('started')->nullable();
            $table->dateTime('finished')->nullable();
            $table->timestamps();
            $table->integer('cms_maestro_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotion_codes');
    }
};
