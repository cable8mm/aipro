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
        Schema::create('good_set_good', function (Blueprint $table) {
            $table->foreignId('good_id');
            $table->foreignId('set_good_id');
            $table->unsignedInteger('count');
            $table->primary(['good_id', 'set_good_id']);
            $table->index(['good_id', 'set_good_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('good_set_good');
    }
};
