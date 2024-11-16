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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id('review_Id');
            $table->string('rating');
            $table->longText('review');
            $table->unsignedBigInteger('book_Id');
            $table->unsignedBigInteger('user_Id');
            $table->foreign('book_Id')->references('book_Id')->on('books')->onDelete('cascade');
            $table->foreign('user_Id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};