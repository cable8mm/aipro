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
        Schema::create('box_inventory_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('box_id');
            $table->string('type', 20);
            $table->bigInteger('quantity');
            $table->string('model', 100);
            $table->unsignedBigInteger('attribute', 100);
            $table->boolean('is_success');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('box_inventory_histories');
    }
};
