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
            $table->integer('ct_box_id')->nullable();
            $table->string('type', 10)->nullable();
            $table->integer('quantity')->nullable();
            $table->string('model', 100)->nullable();
            $table->string('attribute', 100)->nullable();
            $table->boolean('is_success')->nullable();
            $table->dateTime('created')->nullable();
            $table->dateTime('updated')->nullable();
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