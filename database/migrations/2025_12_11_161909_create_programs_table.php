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
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->text('synopsis')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('image')->nullable();
            $table->string('trailer')->nullable();
            $table->enum('platform', ['cinema', 'tv', 'streaming', 'youtube', 'game'])->default('streaming');
            $table->enum('status', ['draft', 'upcoming', 'ongoing', 'completed'])->default('draft');
            $table->string('release_date')->nullable();
            $table->string('duration')->nullable();
            $table->string('rating')->nullable();
            $table->string('director')->nullable();
            $table->string('budget')->nullable();
            $table->integer('episodes')->default(1);
            $table->integer('views')->default(0);
            $table->json('characters')->nullable(); // Array character IDs/slugs
            $table->json('platforms')->nullable(); // Array platforms
            $table->json('production')->nullable(); // JSON production data
            $table->json('gallery')->nullable(); // Array gallery images
            $table->integer('order')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};
