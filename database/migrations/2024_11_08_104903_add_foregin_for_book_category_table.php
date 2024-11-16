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
        Schema::table('book_category', function (Blueprint $table) {
            $table->dropForeign('book_category_book_id_foreign');
            $table->dropForeign('book_category_category_id_foreign');

            $table->foreign('book_Id')->references('book_Id')->on('books')->onDelete('cascade');
            $table->foreign('category_Id')->references('category_Id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('book_category', function (Blueprint $table) {
            $table->dropForeign(['book_Id']);
            $table->dropForeign(['category_Id']);
        });
    }
};