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
        Schema::create('progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('lesson_id');
            $table->foreign('lesson_id')->references('id')->on('lessons');
            $table->string('module_id');
            $table->foreign('module_id')->references('id')->on('modules');
            $table->string('unit_id');
            $table->foreign('unit_id')->references('id')->on('units');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progress');
    }
};
