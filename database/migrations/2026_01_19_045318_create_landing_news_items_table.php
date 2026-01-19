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
        Schema::create('landing_news_items', function (Blueprint $table) {
            $table->id();
            $table->string('category')->nullable();
            $table->string('title');
            $table->text('excerpt')->nullable();
            $table->string('author_name')->nullable();
            $table->string('author_image_path')->nullable();
            $table->date('published_at')->nullable();
            $table->string('image_path')->nullable();
            $table->string('link_url')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('landing_news_items');
    }
};
