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
        Schema::create('b2b_goods', function (Blueprint $table) {
            $table->id();
            $table->integer('cms_maestro_id')->nullable();
            $table->string('goods_no', 150)->nullable();
            $table->string('playauto_master_code', 255)->nullable();
            $table->dateTime('created')->nullable();
            $table->dateTime('modified')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('b2b_goods');
    }
};
