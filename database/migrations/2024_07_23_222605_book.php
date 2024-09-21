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
        Schema::create('book', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('slug');
            $table->float('price');
            $table->float('rating')->default(0);
            $table->integer('rating_count')->default(0);
            $table->integer('hit')->default(0);
            $table->integer('category_id')->default(1);
            $table->integer('stock')->default(1);
            $table->string('page_count');
            $table->string('language');
            $table->string('release_date');
            $table->string('image');
            $table->string('author');
            $table->longText('brief');
            $table->longText('content');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book');
    }
};
