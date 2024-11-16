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
        Schema::table('books', function (Blueprint $table) {
            $table->dropForeign('books_category_id_foreign');
            $table->dropColumn('category_Id');
            $table->string('language')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->unsignedBigInteger('category_Id');
            $table->foreign('category_Id')->references('category_Id')->on('categories')->onDelete('cascade');
            $table->dropColumn('language');
        });
    }
};