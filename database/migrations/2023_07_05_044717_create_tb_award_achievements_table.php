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
        Schema::create('tb_award_achievements', function (Blueprint $table) {
            $table->id();
            $table->string('competition_name');
            $table->string('award_name');
            $table->text('image');
            $table->string('alt');
            $table->date('competition_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_award_achievements');
    }
};