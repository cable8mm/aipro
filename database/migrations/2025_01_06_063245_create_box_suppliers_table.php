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
        Schema::create('box_suppliers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id')->comment('등록자');
            $table->string('name', 255)->nullable();
            $table->string('ordered_email', 255)->nullable();
            $table->string('contact_name', 255)->nullable();
            $table->string('contact_tel', 255)->nullable();
            $table->string('contact_cel', 255)->nullable();
            $table->string('order_method', 50)->nullable();
            $table->string('balance_criteria', 255)->nullable();
            $table->integer('min_order_price')->nullable();
            $table->boolean('is_parceled')->nullable()->default('0');
            $table->text('additional_information')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('box_suppliers');
    }
};
