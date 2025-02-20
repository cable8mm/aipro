<?php

use App\Enums\SafeClass;
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
        Schema::create('item_inventory_snapshots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id');
            $table->foreignId('item_id');
            $table->string('playauto_sku', 50);
            $table->integer('inventory');
            $table->string('safe_class', 20)->default(SafeClass::S1->name);
            $table->string('type', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_inventory_snapshots');
    }
};
