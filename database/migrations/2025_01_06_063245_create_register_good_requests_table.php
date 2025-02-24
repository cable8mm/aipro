<?php

use App\Enums\Status;
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
        Schema::create('register_good_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'author_id')->constrained()->comment('작성자 아이디');
            $table->foreignIdFor(User::class, 'worker_id')->nullable()->constrained()->comment('업무 담당자 아이디');
            $table->string('title', 255);
            $table->string('request_file_url', 255)->nullable();
            $table->string('respond_file_url', 255)->nullable();
            $table->boolean('has_supplier_monitoring_price')->default(false);
            $table->text('memo')->nullable();
            $table->string('status', 50)->default(Status::WAITING->name);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('register_good_requests');
    }
};
