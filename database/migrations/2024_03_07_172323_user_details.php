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
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('tagline')->nullable();
            $table->string('description')->nullable();
            $table->boolean('showDescription')->default(false);
            $table->text('about')->nullable();
            $table->boolean('showAbout')->default(false);
            $table->string('location')->nullable();
            $table->string('website')->nullable();
            $table->string('profile_pic')->nullable();
            $table->string('setting_pic')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_details');
    }
};
