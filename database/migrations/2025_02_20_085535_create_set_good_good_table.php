<?php

use App\Models\Good;
use App\Models\SetGood;
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
        Schema::create('set_good_good', function (Blueprint $table) {
            $table->foreignIdFor(SetGood::class, 'set_good_id')->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Good::class, 'good_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('quantity');
            $table->primary(['set_good_id', 'good_id']);
            $table->index(['set_good_id', 'good_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('set_good_good');
    }
};
