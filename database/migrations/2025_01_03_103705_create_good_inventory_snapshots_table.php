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
        Schema::create('good_inventory_snapshots', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('cms_maestro_id')->nullable();
            $table->unsignedInteger('ct_good_id')->nullable();
            $table->string('playauto_master_code', 255)->nullable();
            $table->integer('inventory')->nullable();
            $table->char('safe_class', 1)->nullable();
            $table->string('type', 50)->nullable();
            $table->dateTime('created')->nullable();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('good_inventory_snapshots');
    }
};