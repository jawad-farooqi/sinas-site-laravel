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
        Schema::create('news', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('slug')->unique();

            $table->string('excerpt', 500)->nullable();
            $table->longText('content')->nullable();

            $table->foreignId('news_category_id')
                ->constrained('news_categories')
                ->restrictOnDelete();

            $table->string('featured_image')->nullable();

            $table->enum('status', [
                'draft', 
                'published', 
                'archived'
            ])->default('draft');

            $table->timestamp('published_at')->nullable();
            $table->timestamp('expires_at')->nullable();

            $table->boolean('is_featured')->default(false);

            $table->foreignId('author_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
