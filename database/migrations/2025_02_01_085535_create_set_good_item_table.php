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
        Schema::create('set_good_item', function (Blueprint $table) {
            $table->foreignId('set_good_id');
            $table->foreignId('item_id');
            $table->unsignedInteger('quantity');
            $table->primary(['item_id', 'set_good_id']);
            $table->index(['item_id', 'set_good_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('set_good_item');
    }
};
