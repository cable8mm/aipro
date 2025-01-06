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
        Schema::create('bundled_goods', function (Blueprint $table) {
            $table->id();
            $table->string('playauto_master_code', 130)->nullable();
            $table->string('name', 130)->nullable();
            $table->string('set_code', 255)->nullable();
            $table->unsignedInteger('goods_price')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bundled_goods');
    }
};
