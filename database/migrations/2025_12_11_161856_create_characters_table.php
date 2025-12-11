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
        Schema::create('characters', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->string('full_name')->nullable();
            $table->string('region')->nullable();
            $table->text('philosophy')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->string('artifact')->nullable();
            $table->string('power')->nullable();
            $table->string('island')->nullable();
            $table->string('origin')->nullable();
            $table->string('dna')->nullable();
            $table->text('attitude')->nullable();
            $table->text('character')->nullable();
            $table->json('colors')->nullable(); // Array warna HEX
            $table->json('color_names')->nullable(); // Array nama warna
            $table->string('image')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('video')->nullable();
            $table->text('description')->nullable();
            $table->enum('status', ['draft', 'published'])->default('draft');
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
        Schema::dropIfExists('characters');
    }
};
