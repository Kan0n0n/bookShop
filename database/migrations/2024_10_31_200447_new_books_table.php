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
        Schema::create('books', function (Blueprint $table) {
            //
            $table->id('book_Id');
            $table->string('title');
            $table->string('isbn')->unique()->nullable();
            $table->longText('description')->nullable();
            $table->string('book_cover_image_path');
            $table->integer('pages')->unsigned()->default(0);
            $table->integer('quantity')->unsigned()->default(0);
            $table->integer('borrowed_copies')->unsigned()->default(0);
            $table->date('released_date')->nullable();
            $table->timestamp('published_date')->nullable();
            $table->unsignedBigInteger('author_id');
            $table->unsignedBigInteger('category_Id');
            $table->unsignedBigInteger('pulisher_Id');
            $table->foreign('author_Id')->references('author_Id')->on('authors')->onDelete('cascade');
            $table->foreign('category_Id')->references('category_Id')->on('categories')->onDelete('cascade');
            $table->foreign('pulisher_Id')->references('pulisher_id')->on('pulishers')->onDelete('cascade');
            $table->timestamps();
        });

        DB::statement('ALTER TABLE books ADD CONSTRAINT check_borrowed_copies CHECK (borrowed_copies <= quantity)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
