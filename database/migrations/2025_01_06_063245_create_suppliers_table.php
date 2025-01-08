<?php

use App\Enums\OrderMethod;
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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('ordered_email', 255)->nullable();
            $table->string('contact_name', 255)->nullable();
            $table->string('contact_tel', 255)->nullable();
            $table->string('contact_cel', 255)->nullable();
            $table->enum('order_method', OrderMethod::toKeys())->nullable();
            $table->integer('min_order_price')->nullable();
            $table->text('additional_information')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
