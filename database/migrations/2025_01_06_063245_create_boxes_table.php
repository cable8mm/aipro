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
        Schema::create('boxes', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->nullable();
            $table->string('code', 50);
            $table->unsignedInteger('size');
            $table->integer('delivery_price')->nullable();
            $table->integer('box_price')->nullable();
            $table->unsignedInteger('inventory')->nullable()->default('0');
            $table->string('memo', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boxes');
    }
};
