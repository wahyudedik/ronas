<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('landing_heroes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('primary_label')->nullable();
            $table->string('primary_url')->nullable();
            $table->string('secondary_label')->nullable();
            $table->string('secondary_url')->nullable();
            $table->string('image')->nullable();
            $table->string('badge_text')->nullable();
            $table->string('badge_icon')->nullable();

            $table->string('stat_one_value')->nullable();
            $table->string('stat_one_label')->nullable();
            $table->string('stat_two_value')->nullable();
            $table->string('stat_two_label')->nullable();
            $table->string('stat_three_value')->nullable();
            $table->string('stat_three_label')->nullable();

            $table->string('event_day')->nullable();
            $table->string('event_month')->nullable();
            $table->string('event_title')->nullable();
            $table->text('event_description')->nullable();
            $table->string('event_button_label')->nullable();
            $table->string('event_button_url')->nullable();
            $table->string('event_countdown_text')->nullable();

            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('landing_heroes');
    }
};
