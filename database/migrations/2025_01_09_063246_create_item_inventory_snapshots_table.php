<?php

use App\Enums\ItemInventoryLevel;
use App\Models\Item;
use App\Models\User;
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
            $table->foreignIdFor(User::class, 'author_id')->constrained()->comment('작성자 아이디');
            $table->foreignIdFor(Item::class)->constrained()->comment('아이템');
            $table->string('playauto_sku', 50);
            $table->integer('inventory');
            $table->string('inventory_level', 20)->default(ItemInventoryLevel::LEVEL_1->name);
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
