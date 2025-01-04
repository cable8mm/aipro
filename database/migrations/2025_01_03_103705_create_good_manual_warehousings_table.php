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
        Schema::create('good_manual_warehousings', function (Blueprint $table) {
            $table->id();
            $table->integer('ct_good_id');
            $table->integer('cms_maestro_id');
            $table->integer('manual_add_inventory_count');
            $table->string('type', 100)->default('미입력');
            $table->text('memo')->nullable();
            $table->dateTime('created')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('good_manual_warehousings');
    }
};
