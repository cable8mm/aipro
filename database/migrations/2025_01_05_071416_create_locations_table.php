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
        Schema::create('locations', function (Blueprint $table) {
            $table->string('id', 36)->primary()->comment('위치 코드');
            $table->string('warehouse_id', 36)->comment('창고 아이디');
            $table->foreign('warehouse_id')->references('id')->on('warehouses');
            $table->string('description', 255)->comment('위치 이름');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
