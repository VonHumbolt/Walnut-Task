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
        Schema::create('incoming_logs', function (Blueprint $table) {
            $table->id();
            $table->string('source');
            $table->string('title');
            $table->string('word_count');
            $table->foreignId('incoming_log_data_id')->constrained('incoming_log_data')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incoming_logs');
    }
};
