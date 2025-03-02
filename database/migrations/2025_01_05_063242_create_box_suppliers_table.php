<?php

use App\Enums\OrderMethod;
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
        Schema::create('box_suppliers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'author_id')->constrained()->comment('작성자 아이디');
            $table->string('name', 255)->nullable();
            $table->string('ordered_email', 255)->nullable();
            $table->string('contact_name', 255)->nullable();
            $table->string('contact_tel', 255)->nullable();
            $table->string('contact_cel', 255)->nullable();
            $table->enum('order_method', OrderMethod::keys())->default(OrderMethod::PHONE->value)->comment('주문방식');
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
