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
        Schema::create('hero_context', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('header_big');
            $table->string('header_medium');
            $table->string('header_small');
            $table->string('button_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hero_context');

    }
};
