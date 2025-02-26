<?php

use App\Enums\ChannelStatus;
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
        Schema::create('channels', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'author_id')->constrained()->comment('작성자 아이디');
            $table->string('name', 255);
            $table->string('playauto_site', 190)->nullable();
            $table->string('siteid', 100)->nullable();
            $table->decimal('fee_rate', 5, 2)->nullable();
            $table->unsignedInteger('total_good_count')->nullable();
            $table->unsignedInteger('total_sale_good_count')->nullable();
            $table->integer('total_sold_out_good_count')->nullable();
            $table->integer('total_no_sale_good_count')->nullable();
            $table->string('filepath', 190)->nullable();
            $table->dateTime('last_processed_at')->nullable();
            $table->text('memo')->nullable();
            $table->boolean('is_active')->default(true);
            $table->string('status', 100)->default(ChannelStatus::UPLOAD_COMPLETED->name);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('channels');
    }
};
