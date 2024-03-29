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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('category_id')->constrained();
            // $table->integer('user_id');
            $table->integer('parent_id')->nullable();
            $table->string('title', 100);
            $table->string('metaTitle', 100)->nullable();
            $table->string('slug', 100)->unique();
            $table->tinyText('summary')->nullable();
            $table->boolean('published');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            $table->timestamp('published_at')->nullable();
            $table->string('image', 255)->nullable();
            $table->longText('content');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
