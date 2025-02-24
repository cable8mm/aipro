<?php

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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'author_id')->constrained()->comment('작성자 아이디');
            $table->string('name', 50);
            $table->string('contact_name', 50)->nullable();
            $table->string('contact_email', 80)->nullable();
            $table->string('contact_cel', 40)->nullable();
            $table->string('contact_tel', 40)->nullable();
            $table->string('balance_criteria', 100)->nullable()->comment('정산 기준');
            $table->text('additional_information')->nullable()->comment('판매자 정보 수동 싱크기능 제공 유무');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
