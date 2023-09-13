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
        Schema::create('tb_speaking_opportunities', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('video_link')->nullable();
            $table->text('image')->nullable();
            $table->string('alt');
            $table->text('description');
            $table->enum('is_highlight', ['false', 'true'])->default('false');
            $table->date('event_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_speaking_opportunities');
    }
};
