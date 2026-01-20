<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('campus_highlights', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('category_label')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('stat_one_icon')->nullable();
            $table->string('stat_one_label')->nullable();
            $table->string('stat_two_icon')->nullable();
            $table->string('stat_two_label')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('campus_highlights');
    }
};
