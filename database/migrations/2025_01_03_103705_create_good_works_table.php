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
        Schema::create('good_works', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('cms_maestro_id')->nullable();
            $table->unsignedInteger('ct_good_id')->nullable();
            $table->text('description_json')->nullable();
            $table->boolean('is_created')->nullable();
            $table->dateTime('created')->nullable();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('good_works');
    }
};