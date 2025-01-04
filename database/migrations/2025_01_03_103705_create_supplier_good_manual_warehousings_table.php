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
        Schema::create('supplier_good_manual_warehousings', function (Blueprint $table) {
            $table->id();
            $table->integer('ct_supplier_good_id')->nullable();
            $table->integer('cms_maestro_id')->nullable();
            $table->integer('manual_add_inventory_count')->nullable();
            $table->text('memo')->nullable();
            $table->dateTime('created')->nullable();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplier_good_manual_warehousings');
    }
};