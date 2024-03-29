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
        Schema::create('lessons', function (Blueprint $table) {
            $table->string('id')->unique();
            $table->string('module_id');
            $table->foreign('module_id')->references('id')->on('modules');
            $table->string('unit_id');
            $table->foreign('unit_id')->references('id')->on('units');
            $table->integer('level');
            $table->string('name');
            $table->string('achievement');
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
