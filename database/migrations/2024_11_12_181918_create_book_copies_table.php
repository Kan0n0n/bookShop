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
        Schema::create('book_copies', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('book_Id');
            $table->unsignedBigInteger('copy_number');
            $table->enum('status', ['available','borrowed', 'reserved', 'lost'])->default('available');
            $table->foreign('book_Id')->references('book_Id')->on('books')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_copies');
    }
};