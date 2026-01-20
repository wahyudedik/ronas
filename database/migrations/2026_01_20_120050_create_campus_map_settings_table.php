<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('campus_map_settings', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->text('embed_url')->nullable();
            $table->string('location_title')->nullable();
            $table->string('location_address')->nullable();
            $table->string('stat_one_icon')->nullable();
            $table->string('stat_one_label')->nullable();
            $table->string('stat_two_icon')->nullable();
            $table->string('stat_two_label')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('campus_map_settings');
    }
};
