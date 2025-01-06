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
        Schema::create('option_goods', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('cms_maestro_id')->nullable();
            $table->string('playauto_master_code', 130);
            $table->string('godo_code', 255)->nullable();
            $table->string('name', 130);
            $table->integer('option_count')->nullable()->default('0');
            $table->integer('my_shop_sale_option_count')->nullable()->default('0');
            $table->integer('other_shop_sale_option_count')->nullable()->default('0');
            $table->boolean('is_active')->nullable()->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('option_goods');
    }
};
