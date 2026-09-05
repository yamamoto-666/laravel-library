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
            $table->dropForeign(['author_id']);
        });

        Schema::table('books', function (Blueprint $table) {
            $table->string('cover_photo', 255)->nullable()->change();
            $table->foreignId('author_id')->nullable()->change();
            $table->foreign('author_id')->references('id')->on('authors')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropForeign(['author_id']);
        });

        Schema::table('books', function (Blueprint $table) {
            $table->string('cover_photo', 255)->nullable(false)->change();
            $table->foreignId('author_id')->nullable(false)->change();
            $table->foreign('author_id')->references('id')->on('authors');
        });
    }
};
