<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('campus_virtual_tour_features', function (Blueprint $table) {
            $table->id();
            $table->foreignId('campus_virtual_tour_id')
                ->constrained('campus_virtual_tours')
                ->cascadeOnDelete();
            $table->string('title');
            $table->string('description')->nullable();
            $table->string('icon_class')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('campus_virtual_tour_features');
    }
};
