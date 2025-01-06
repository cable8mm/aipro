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
        Schema::create('box_manual_warehousings', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('ct_box_id');
            $table->integer('cms_maestro_id');
            $table->string('type', 100)->default('미입력');
            $table->integer('manual_add_inventory_count');
            $table->text('memo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('box_manual_warehousings');
    }
};
