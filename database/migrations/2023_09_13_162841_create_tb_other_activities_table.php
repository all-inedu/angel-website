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
        Schema::create('tb_other_activities', function (Blueprint $table) {
            $table->id();
            $table->string('organization_name');
            $table->string('roles');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->text('image')->nullable();
            $table->string('alt')->nullable();
            $table->text('description');
            $table->text('brief_description');
            $table->enum('is_highlight', ['inactive', 'active'])->default('inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_other_activities');
    }
};
