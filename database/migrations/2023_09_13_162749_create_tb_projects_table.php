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
        Schema::create('tb_projects', function (Blueprint $table) {
            $table->id();
            $table->string('organization_name');
            $table->string('roles');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->text('image')->nullable();
            $table->string('alt')->nullable();
            $table->text('description');
            $table->string('button_title')->nullable();
            $table->text('button_link')->nullable();
            $table->enum('is_highlight', ['false', 'true'])->default('false');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_projects');
    }
};
